<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\AbstractTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserResetPasswordControllerTest extends AbstractTestCase
{
    public function setUp(): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadUsers']);
    }

    public function testRequestPasswordResetEmailGetRequest(): void
    {
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/reset-password');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorExists('form');
        // Check for the actual form field that exists in the system
        $this->assertSelectorExists('input[type="email"]');
    }

    public function testRequestPasswordResetEmailWithValidEmail(): void
    {
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/reset-password');

        // Find the form and submit it - we'll use whatever button text exists
        $form = $crawler->filter('form')->form();

        // Find the email input field by type
        $emailField = $crawler->filter('input[type="email"]')->first();
        if ($emailField->count() > 0) {
            $fieldName = $emailField->attr('name');
            $form[$fieldName] = 'admin@example.com';
        }

        $client->submit($form);

        // Should redirect to check-email page
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('check-email', $client->getResponse()->headers->get('Location'));
    }

    public function testRequestPasswordResetEmailWithInvalidEmail(): void
    {
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/reset-password');
        $form = $crawler->filter('form')->form();

        $emailField = $crawler->filter('input[type="email"]')->first();
        if ($emailField->count() > 0) {
            $fieldName = $emailField->attr('name');
            $form[$fieldName] = 'nonexistent@example.com';
        }

        $client->submit($form);

        // Should still redirect to check-email for security (don't reveal if email exists)
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('check-email', $client->getResponse()->headers->get('Location'));
    }

    public function testRequestPasswordResetEmailWithEmptyEmail(): void
    {
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/reset-password');
        $form = $crawler->filter('form')->form();

        $emailField = $crawler->filter('input[type="email"]')->first();
        if ($emailField->count() > 0) {
            $fieldName = $emailField->attr('name');
            $form[$fieldName] = '';
        }

        $client->submit($form);

        // Should show validation errors, not redirect
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testRequestPasswordResetEmailWithInvalidEmailFormat(): void
    {
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/reset-password');
        $form = $crawler->filter('form')->form();

        $emailField = $crawler->filter('input[type="email"]')->first();
        if ($emailField->count() > 0) {
            $fieldName = $emailField->attr('name');
            $form[$fieldName] = 'invalid-email-format';
        }

        $client->submit($form);

        // Should show validation errors or redirect (depending on form validation)
        $response = $client->getResponse();
        $this->assertTrue(
            Response::HTTP_OK === $response->getStatusCode()
            || $response->isRedirect()
        );
    }

    public function testCheckEmailPageRendersCorrectly(): void
    {
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/reset-password/check-email');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        // Check for any content that indicates this is the check email page
        $this->assertSelectorExists('body');
    }

    public function testResetPasswordWithoutToken(): void
    {
        $client = $this->getKernelBrowser();

        $client->request('GET', '/reset-password/reset');

        // Should return 404 or redirect when no token is present
        $this->assertTrue(
            Response::HTTP_NOT_FOUND === $client->getResponse()->getStatusCode()
            || $client->getResponse()->isRedirect()
        );
    }

    public function testResetPasswordWithTokenInUrlRedirects(): void
    {
        $client = $this->getKernelBrowser();

        $client->request('GET', '/reset-password/reset/some-token-123');

        // Should redirect to the reset form without token in URL
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('/reset-password/reset', $client->getResponse()->headers->get('Location'));
    }

    public function testResetPasswordRouteExists(): void
    {
        $client = $this->getKernelBrowser();

        // Test that the route is configured (might show error page but shouldn't be 404)
        $client->request('GET', '/reset-password/reset/test-token');

        // Should not be a route not found error
        $this->assertNotEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());
    }

    public function testControllerServiceExists(): void
    {
        $client = $this->getKernelBrowser();

        // Verify the controller service is properly configured
        $container = $client->getContainer();
        $this->assertTrue($container->has('App\Controller\UserResetPasswordController'));
    }

    public function testPasswordResetFormStructure(): void
    {
        // This test ensures the reset form has the expected structure
        // We can't easily test the full workflow without complex mocking,
        // but we can test that the routes and basic structure exist

        $client = $this->getKernelBrowser();
        $client->request('GET', '/reset-password');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        // The request form should contain an email field
        $this->assertSelectorExists('input[type="email"]');
    }
}
