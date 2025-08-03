<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\AbstractTestCase;

class RobotsControllerTest extends AbstractTestCase
{
    public function testRobotsTxtDisallow()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/robots.txt',
            [],
            [],
            ['HTTP_HOST' => 'redev01.canopus.uberspace.de']
        );

        $this->assertEquals(
            <<<EOT
            User-agent: *
            Disallow: /
            EOT,
            $client->getResponse()->getContent()
        );
        $this->assertEquals('text/plain; charset=UTF-8', $client->getResponse()->headers->get('content-type'));
    }

    public function testRobotsTxtAllow()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/robots.txt',
            [],
            [],
            ['HTTP_HOST' => 'retromat.org']
        );

        $this->assertEquals(
            <<<EOT
            User-agent: *
            Disallow:
            Crawl-delay: 1
            
            Sitemap: https://retromat.org/sitemap.xml
            EOT,
            $client->getResponse()->getContent()
        );
        $this->assertEquals('text/plain; charset=UTF-8', $client->getResponse()->headers->get('content-type'));
    }

    public function testRobotsTxtCachingHeaders(): void
    {
        $client = static::createClient();

        // Test robots.txt with retromat.org host (allow)
        $client->request(
            'GET',
            '/robots.txt',
            [],
            [],
            ['HTTP_HOST' => 'retromat.org']
        );

        $response = $client->getResponse();
        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);

        // Test robots.txt with other host (disallow)
        $client->request(
            'GET',
            '/robots.txt',
            [],
            [],
            ['HTTP_HOST' => 'redev01.canopus.uberspace.de']
        );

        $response = $client->getResponse();
        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);
    }
}
