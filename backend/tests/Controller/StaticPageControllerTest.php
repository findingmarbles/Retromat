<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\AbstractTestCase;

class StaticPageControllerTest extends AbstractTestCase
{
    public function testStaticPagesCachingHeaders()
    {
        $client = static::createClient();

        $staticPages = [
            '/en/about',
            '/en/books',
            '/en/ebook',
            '/en/membership',
            '/en/print',
            '/en/sources',
        ];

        foreach ($staticPages as $url) {
            $client->request('GET', $url);
            $response = $client->getResponse();

            $this->assertEquals(200, $response->getStatusCode(), "Failed for URL: $url");

            $cacheControl = $response->headers->get('Cache-Control');

            $this->assertStringContainsString('public', $cacheControl, "Missing 'public' in Cache-Control for URL: $url");
            $this->assertStringContainsString('s-maxage=84600', $cacheControl, "Missing 's-maxage=84600' in Cache-Control for URL: $url");
            $this->assertStringContainsString('max-age=3600', $cacheControl, "Missing 'max-age=3600' in Cache-Control for URL: $url");
        }
    }
}
