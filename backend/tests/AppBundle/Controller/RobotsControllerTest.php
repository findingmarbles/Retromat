<?php
declare(strict_types = 1);

namespace tests\AppBundle\Controller;

// tests directory is not available to the autoloader, so we have to manually require these files:
require_once 'DataFixtures/LoadActivityData.php';

use Liip\FunctionalTestBundle\Test\WebTestCase;

class RobotsControllerTest extends WebTestCase
{
    public function testRobotsClosed()
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
            '
User-agent: *
Disallow: /
',
            $client->getResponse()->getContent()
        );
        $this->assertEquals('text/plain; charset=UTF-8', $client->getResponse()->headers->get('content-type'));
    }

//    @todo Can not yet distinguish hostnames in this test, but verified that it's working manually.
//    public function testRobotsOpen()
//    {
//        $client = static::createClient();
//
//        $client->request(
//            'GET',
//            '/robots.txt',
//            array(),
//            array(),
//            array('HTTP_HOST' => 'retromat.org')
//        );
//
//        $this->assertEquals(
//            '
//User-agent: *
//Disallow:
//Crawl-delay: 1
//
//Sitemap: https://retromat.org/sitemap.xml',
//            $client->getResponse()->getContent()
//        );
//        $this->assertEquals('text/plain; charset=UTF-8', $client->getResponse()->headers->get('content-type'));
//    }
}