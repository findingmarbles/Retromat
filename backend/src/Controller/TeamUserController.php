<?php

namespace App\Controller;

use App\Form\UserPasswordType;
use App\Model\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('{_locale}/team/user')]
class TeamUserController extends AbstractController
{
    private UserManager $userManager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param Request $request
     * @return Response
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
}
