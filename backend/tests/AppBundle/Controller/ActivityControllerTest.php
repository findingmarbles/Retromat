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

    public function testActivitySourcePlaceholder()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $client->request('GET', '/activities/77');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="https://leanpub.com/ErfolgreicheRetrospektiven">Judith Andresen</a>',
            $activity['source']
        );

        $client->request('GET', '/activities/5');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $activity['source']
        );
    }

    public function testActivitySourcePlaceholderAndString()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $client->request('GET', '/activities/15');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.amazon.com/Agile-Retrospectives-Making-Teams-Great/dp/0977616649/">Agile Retrospectives</a> who took it from \'The Satir Model: Family Therapy and Beyond\'',
            $activity['source']
        );

        $client->request('GET', '/activities/37');
        $activity = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.amazon.com/Innovation-Games-Creating-Breakthrough-Collaborative/dp/0321437292/">Luke Hohmann</a>, found at <a href="http://www.ayeconference.com/appreciativeretrospective/">Diana Larsen</a>',
            $activity['source']
        );
    }
}