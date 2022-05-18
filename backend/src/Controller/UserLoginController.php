<?php

namespace App\Controller;

use App\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserLoginController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param UrlGeneratorInterface $urlGenerator
     * @return Response
     */
    #[Route(path: '/login', name: 'user_login')]
    public function login(AuthenticationUtils $authenticationUtils, UrlGeneratorInterface $urlGenerator): Response
    {
        if ($this->getUser()) {
            return new RedirectResponse($urlGenerator->generate(UserAuthenticator::AUTHENTICATION_SUCCESS_ROUTE));
        }

        return $this->render(
            'user/login/login.html.twig', [
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }

    /**
     * @return void
     */
    #[Route(path: '/logout', name: 'user_logout')]
    public function logout(): void
    {
        throw new \LogicException('Intercepted by the logout key on our firewall.');
    }
}
