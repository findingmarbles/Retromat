<?php
declare(strict_types=1);

namespace tests\AppBundle\Controller;

// tests directory is not available to the autoloader, so we have to manually require these files:
require_once 'DataFixtures/LoadActivityData.php';

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityControllerTest extends WebTestCase
{
    public function setUp()
    {
        // empty database before each test.
        // any test that needs data to function has to specify the data needed explicitly.
        $this->loadFixtures([]);
    }

    public function testActivityName()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $client->request('GET', '/activities/32');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Emoticon Project Gauge',
            $activity['name']
        );

        $client->request('GET', '/activities/59');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Happiness Histogram',
            $activity['name']
        );

        $client->request('GET', '/activities/80');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Repeat &amp; Avoid',
            $activity['name']
        );
    }

    public function testActivitySourceSimpleString()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $client->request('GET', '/activities/17');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://fairlygoodpractices.com/samolo.htm">Fairly good practices</a>',
            $activity['source']
        );

        $client->request('GET', '/activities/80');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.infoq.com/minibooks/agile-retrospectives-value">Luis Goncalves</a>',
            $activity['source']
        );
    }
}