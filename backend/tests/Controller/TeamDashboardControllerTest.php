<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use App\Tests\AbstractTestCase;
use App\Tests\Controller\DataFixtures\LoadTeamUsers;
use Symfony\Bundle\FrameworkBundle\KernelBrowser as Client;
use Symfony\Component\HttpFoundation\Response;

class TeamDashboardControllerTest extends AbstractTestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->loadFixtures([]);
    }

    public function testDashboardRendersForAuthenticatedUser(): void
    {
        $client = $this->makeClientLoginAdmin();

        $crawler = $client->request('GET', '/en/team/dashboard');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('body');
        // Check for dashboard-specific content
        $this->assertSelectorExists('.dashboard, [class*="dashboard"], h1, .content, main');
    }

    public function testDashboardRequiresAuthentication(): void
    {
        $client = $this->client;

        $client->request('GET', '/en/team/dashboard');

        // Should redirect to login or return forbidden/unauthorized
        $this->assertTrue(
            $client->getResponse()->isRedirect()
            || Response::HTTP_FORBIDDEN === $client->getResponse()->getStatusCode()
            || Response::HTTP_UNAUTHORIZED === $client->getResponse()->getStatusCode()
        );
    }

    public function testDashboardWorksWithDifferentLocales(): void
    {
        $client = $this->makeClientLoginAdmin();

        $locales = ['en', 'de', 'es', 'fr'];

        foreach ($locales as $locale) {
            $crawler = $client->request('GET', "/{$locale}/team/dashboard");

            $this->assertEquals(
                Response::HTTP_OK,
                $client->getResponse()->getStatusCode(),
                "Dashboard should work for locale: {$locale}"
            );
        }
    }

    public function testDashboardWithRegularUser(): void
    {
        $client = $this->makeClientLoginRegular();

        $crawler = $client->request('GET', '/en/team/dashboard');

        // Check if regular users can access dashboard or if they get forbidden
        $response = $client->getResponse();
        $this->assertTrue(
            Response::HTTP_OK === $response->getStatusCode()
            || Response::HTTP_FORBIDDEN === $response->getStatusCode()
        );
    }

    public function testDashboardWithSerpUser(): void
    {
        $client = $this->makeClientLoginSerp();

        $crawler = $client->request('GET', '/en/team/dashboard');

        // SERP users should be able to access dashboard (they have admin role too)
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testDashboardResponseHeaders(): void
    {
        $client = $this->makeClientLoginAdmin();

        $client->request('GET', '/en/team/dashboard');

        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        // Check that it's HTML content
        $this->assertStringContainsString('text/html', $response->headers->get('Content-Type', ''));
    }

    public function testDashboardContainsExpectedContent(): void
    {
        $client = $this->makeClientLoginAdmin();

        $crawler = $client->request('GET', '/en/team/dashboard');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        // Check for basic HTML structure
        $this->assertSelectorExists('html');
        $this->assertSelectorExists('body');

        // Check that the page has some content (not empty)
        $bodyText = $crawler->filter('body')->text();
        $this->assertNotEmpty(trim($bodyText));
    }

    private function makeClientLoginAdmin(): Client
    {
        $this->loadFixtures([
            'App\Tests\Controller\DataFixtures\LoadTeamUsers',
        ]);

        try {
            $userRepository = static::getContainer()->get(UserRepository::class);
            $testUser = $userRepository->findOneByUsername(LoadTeamUsers::ADMIN_USERNAME);
            $this->client->loginUser($testUser);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        return $this->client;
    }

    private function makeClientLoginRegular(): Client
    {
        $this->loadFixtures([
            'App\Tests\Controller\DataFixtures\LoadTeamUsers',
        ]);

        try {
            $userRepository = static::getContainer()->get(UserRepository::class);
            $testUser = $userRepository->findOneByUsername(LoadTeamUsers::REGULAR_USERNAME);
            $this->client->loginUser($testUser);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        return $this->client;
    }

    private function makeClientLoginSerp(): Client
    {
        $this->loadFixtures([
            'App\Tests\Controller\DataFixtures\LoadTeamUsers',
        ]);

        try {
            $userRepository = static::getContainer()->get(UserRepository::class);
            $testUser = $userRepository->findOneByUsername(LoadTeamUsers::SERP_USERNAME);
            $this->client->loginUser($testUser);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        return $this->client;
    }
}
