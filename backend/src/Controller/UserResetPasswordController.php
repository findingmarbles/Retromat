<?php

namespace App\Controller;

use App\Form\UserResetPasswordFormType;
use App\Form\UserResetPasswordRequestFormType;
use App\Model\User\Exception\UserExceptionInterface;
use App\Model\User\Mailer\UserResetPasswordMailer;
use App\Model\User\UserManager;
use App\Model\User\UserResetPasswordManager;
use App\Model\User\UserResetPasswordSessionManager;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reset-password')]
class UserResetPasswordController extends AbstractController
{
    private UserManager $userManager;
    private UserResetPasswordManager $userResetPasswordManager;
    private UserResetPasswordSessionManager $userResetPasswordSessionManager;
    private UserResetPasswordMailer $userResetPasswordMailer;
    private UserRepository $userRepository;

    /**
     * @param UserManager $userManager
     * @param UserResetPasswordManager $userResetPasswordManager
     * @param UserResetPasswordSessionManager $userResetPasswordSessionManager
     * @param UserResetPasswordMailer $userResetPasswordMailer
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserManager $userManager,
        UserResetPasswordManager $userResetPasswordManager,
        UserResetPasswordSessionManager $userResetPasswordSessionManager,
        UserResetPasswordMailer $userResetPasswordMailer,
        UserRepository $userRepository
    ) {
        $this->userManager = $userManager;
        $this->userResetPasswordManager = $userResetPasswordManager;
        $this->userResetPasswordSessionManager = $userResetPasswordSessionManager;
        $this->userResetPasswordMailer = $userResetPasswordMailer;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    #[Route('', name: 'user_request_password_reset_email')]
    public function requestPasswordResetEmail(Request $request): Response
    {
        $form = $this->createForm(UserResetPasswordRequestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->processSendingPasswordResetEmail(
                $form->get('email')->getData()
            );
        }

        return $this->render('user/reset-password/request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return Response
     */
    #[Route('/check-email', name: 'user_check_email')]
    public function checkEmail(): Response
    {
        return $this->render('user/reset-password/check-email.html.twig', [
            'resetToken' => $this->userResetPasswordSessionManager->getUserResetPasswordTokenObject(),
        ]);
    }

    /**
     * @param Request $request
     * @param string|null $token
     * @return Response
     * @throws \App\Model\User\Exception\InvalidUserResetPasswordTokenException
     */
    #[Route('/reset/{token}', name: 'user_reset_password')]
    public function resetPassword(Request $request, string $token = null): Response
    {
        if ($token) {
            $this->userResetPasswordSessionManager->setToken($token);
            return $this->redirectToRoute('user_reset_password');
        }

        $token = $this->userResetPasswordSessionManager->getToken();
        if (null === $token) {
            throw $this->createNotFoundException('No valid token given.');
        }

        try {
            $user = $this->userResetPasswordManager->validateTokenAndFetchUser($token);
        } catch (UserExceptionInterface $userException) {
            $this->addFlash(
                'reset_password_error',
                \sprintf('Something went wrong with the validation: "%s".', $userException->getErrorMessage())
            );
            return $this->redirectToRoute('user_request_password_reset_email');
        }

        $form = $this->createForm(UserResetPasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userResetPasswordManager->deleteUserResetPasswordRequest($token);
            $this->userManager->persist($user);
            $this->userResetPasswordSessionManager->flushSession();
            $this->userResetPasswordManager->deleteExpiredResetRequests();

            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/reset-password/reset.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param string $email
     * @return RedirectResponse
     */
    private function processSendingPasswordResetEmail(string $email): RedirectResponse
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (!$user) {
            return $this->redirectToRoute('user_check_email');
        }

        try {
            $userResetPasswordToken = $this->userResetPasswordManager->generateUserResetPasswordToken($user);
        } catch (\Exception|UserExceptionInterface $exception) {
            return $this->redirectToRoute('user_check_email');
        }

        $this->userResetPasswordMailer->send(
            $user->getEmail(),
            [
                'token' => $userResetPasswordToken->getToken()
            ]
        );

        $this->userResetPasswordSessionManager->setUserResetPasswordTokenObject($userResetPasswordToken);

        return $this->redirectToRoute('user_check_email');
    }
}
