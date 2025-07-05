<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\TeamUserType;
use App\Form\UserPasswordType;
use App\Model\User\UserManager;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('{_locale}/team/user')]
class TeamUserController extends AbstractController
{
    private UserManager $userManager;
    private UserRepository $userRepository;

    public function __construct(UserManager $userManager, UserRepository $userRepository)
    {
        $this->userManager = $userManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Exception
     */
    #[Route('/password', name: 'team_user_password', methods: ['POST', 'GET'])]
    public function password(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->userManager->persist($user);
                $this->addFlash('success', 'Successfully updated password.');
            } catch (\Exception $exception) {
                throw $exception;
            }
        }

        return $this->render('team/user/password.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/', name: 'team_user_index', methods: ['GET'])]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render(
            'team/user/index.html.twig',
            [
                'users' => $this->userRepository->findAll(),
            ]
        );
    }

    /**
     * @throws \Exception
     */
    #[Route('/new', name: 'team_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $this->userManager->create();
        $form = $this->createForm(TeamUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userManager->persist($user);
            $this->addFlash('success', \sprintf('Successfully added new user with password "%s".', $this->userManager->getPlainPassword()));

            return $this->redirectToRoute('team_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('team/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'team_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('team/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('/{id}/edit', name: 'team_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(TeamUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userManager->persist($user);
            $this->addFlash('success', \sprintf('Successfully updated user "%s".', $user->getUsername()));

            return $this->redirectToRoute('team_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('team/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'team_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->userManager->drop($user);
        }

        return $this->redirectToRoute('team_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
