<?php

declare(strict_types=1);

namespace App\Tests\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use App\Tests\AbstractTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class UserAuthenticatorTest extends AbstractTestCase
{
    private UserAuthenticator $authenticator;
    /** @var UserRepository&MockObject */
    private UserRepository $userRepository;
    /** @var UrlGeneratorInterface&MockObject */
    private UrlGeneratorInterface $urlGenerator;

    public function setUp(): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadUsers']);

        $this->userRepository = $this->createMock(UserRepository::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);

        $this->authenticator = new UserAuthenticator(
            $this->urlGenerator,
            $this->userRepository
        );
    }

    public function testAuthenticateCreatesPassportWithUserBadge(): void
    {
        $user = new User();
        $user->setUsername('testuser');
        $user->setEnabled(true);

        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', 'testuser');
        $request->request->set('password', 'testpassword');
        $request->request->set('_csrf_token', 'csrf_token_value');
        $request->setSession(new Session(new MockArraySessionStorage()));

        $passport = $this->authenticator->authenticate($request);

        $this->assertInstanceOf(Passport::class, $passport);

        $userBadge = $passport->getBadge(UserBadge::class);
        $this->assertInstanceOf(UserBadge::class, $userBadge);
        $this->assertEquals('testuser', $userBadge->getUserIdentifier());

        $passwordCredentials = $passport->getBadge(PasswordCredentials::class);
        $this->assertInstanceOf(PasswordCredentials::class, $passwordCredentials);

        $csrfBadge = $passport->getBadge(CsrfTokenBadge::class);
        $this->assertInstanceOf(CsrfTokenBadge::class, $csrfBadge);
    }

    public function testAuthenticateStoresUsernameInSession(): void
    {
        $session = new Session(new MockArraySessionStorage());
        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', 'testuser');
        $request->request->set('password', 'testpassword');
        $request->request->set('_csrf_token', 'csrf_token_value');
        $request->setSession($session);

        $this->authenticator->authenticate($request);

        $this->assertEquals('testuser', $session->get(Security::LAST_USERNAME));
    }

    public function testAuthenticateWithEmptyUsername(): void
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', '');
        $request->request->set('password', 'testpassword');
        $request->request->set('_csrf_token', 'csrf_token_value');
        $request->setSession(new Session(new MockArraySessionStorage()));

        $passport = $this->authenticator->authenticate($request);

        $userBadge = $passport->getBadge(UserBadge::class);
        if ($userBadge instanceof UserBadge) {
            $this->assertEquals('', $userBadge->getUserIdentifier());
        }
    }

    public function testOnAuthenticationSuccessWithTargetPath(): void
    {
        $session = new Session(new MockArraySessionStorage());
        $session->set('_security.main.target_path', '/custom/target');

        $request = new Request();
        $request->setSession($session);

        $token = $this->createMock(TokenInterface::class);

        $response = $this->authenticator->onAuthenticationSuccess($request, $token, 'main');

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('/custom/target', $response->getTargetUrl());
    }

    public function testOnAuthenticationSuccessWithoutTargetPath(): void
    {
        $this->urlGenerator
            ->expects($this->once())
            ->method('generate')
            ->with(UserAuthenticator::AUTHENTICATION_SUCCESS_ROUTE)
            ->willReturn('/team/dashboard');

        $session = new Session(new MockArraySessionStorage());
        $request = new Request();
        $request->setSession($session);

        $token = $this->createMock(TokenInterface::class);

        $response = $this->authenticator->onAuthenticationSuccess($request, $token, 'main');

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('/team/dashboard', $response->getTargetUrl());
    }

    public function testConstants(): void
    {
        $this->assertEquals('user_login', UserAuthenticator::LOGIN_ROUTE);
        $this->assertEquals('team_dashboard', UserAuthenticator::AUTHENTICATION_SUCCESS_ROUTE);
    }

    public function testAuthenticateWithMissingPassword(): void
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', 'testuser');
        // No password provided
        $request->request->set('_csrf_token', 'csrf_token_value');
        $request->setSession(new Session(new MockArraySessionStorage()));

        $passport = $this->authenticator->authenticate($request);

        $passwordCredentials = $passport->getBadge(PasswordCredentials::class);
        $this->assertInstanceOf(PasswordCredentials::class, $passwordCredentials);
    }

    public function testAuthenticateWithMissingCsrfToken(): void
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', 'testuser');
        $request->request->set('password', 'testpassword');
        // No CSRF token provided
        $request->setSession(new Session(new MockArraySessionStorage()));

        $passport = $this->authenticator->authenticate($request);

        $csrfBadge = $passport->getBadge(CsrfTokenBadge::class);
        $this->assertInstanceOf(CsrfTokenBadge::class, $csrfBadge);
    }

    public function testUserBadgeCallbackWithExistingUser(): void
    {
        $user = new User();
        $user->setUsername('testuser');
        $user->setEnabled(true);

        $this->userRepository
            ->method('findOneBy')
            ->with([
                'username' => 'testuser',
                'enabled' => 1,
            ])
            ->willReturn($user);

        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', 'testuser');
        $request->request->set('password', 'testpassword');
        $request->request->set('_csrf_token', 'csrf_token_value');
        $request->setSession(new Session(new MockArraySessionStorage()));

        $passport = $this->authenticator->authenticate($request);
        $userBadge = $passport->getBadge(UserBadge::class);
        if ($userBadge instanceof UserBadge) {
            $userLoader = $userBadge->getUserLoader();
            $loadedUser = $userLoader('testuser');
            $this->assertSame($user, $loadedUser);
        }
    }

    public function testUserBadgeCallbackWithNonExistentUser(): void
    {
        $this->userRepository
            ->method('findOneBy')
            ->with([
                'username' => 'nonexistent',
                'enabled' => 1,
            ])
            ->willReturn(null);

        $request = new Request();
        $request->setMethod('POST');
        $request->request->set('username', 'nonexistent');
        $request->request->set('password', 'testpassword');
        $request->request->set('_csrf_token', 'csrf_token_value');
        $request->setSession(new Session(new MockArraySessionStorage()));

        $passport = $this->authenticator->authenticate($request);
        $userBadge = $passport->getBadge(UserBadge::class);
        if ($userBadge instanceof UserBadge) {
            $userLoader = $userBadge->getUserLoader();
            $loadedUser = $userLoader('nonexistent');
            $this->assertNull($loadedUser);
        }
    }

    public function testAuthenticatorIntegrationWithLoginController(): void
    {
        // This test verifies that the authenticator works with the actual login process
        $client = $this->getKernelBrowser();

        // Verify failed login doesn't cause errors
        $client->request('POST', '/en/login', [
            'username' => 'nonexistent',
            'password' => 'wrongpassword',
            '_csrf_token' => 'invalid_token',
        ]);

        // Should redirect or show error, not crash
        $this->assertTrue(
            $client->getResponse()->isRedirect()
            || Response::HTTP_OK === $client->getResponse()->getStatusCode()
        );
    }

    public function testAuthenticatorServiceConfiguration(): void
    {
        // Verify the authenticator is properly configured as a service
        $client = $this->getKernelBrowser();
        $container = $client->getContainer();

        $this->assertTrue(
            $container->has(UserAuthenticator::class)
            || $container->has('App\Security\UserAuthenticator')
        );
    }
}
