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
            array(),
            array(),
            array('HTTP_HOST' => 'redev01.canopus.uberspace.de')
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
            array(),
            array(),
            array('HTTP_HOST' => 'retromat.org')
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
}
