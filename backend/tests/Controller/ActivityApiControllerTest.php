<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\AbstractTestCase;

final class ActivityApiControllerTest extends AbstractTestCase
{
    public function setUp(): void
    {
        $this->loadFixtures([]);
    }

    /** @medium */
    public function testActivityNameEnglish()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);

        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/32');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Emoticon Project Gauge',
            $activity['name']
        );

        $client->request('GET', '/api/activity/59');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Happiness Histogram',
            $activity['name']
        );

        $client->request('GET', '/api/activity/80');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Repeat &amp; Avoid',
            $activity['name']
        );
    }

    public function testActivityNameGerman()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/32?locale=de');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Projekt-Gef&uuml;hlsmesser',
            $activity['name']
        );

        $client->request('GET', '/api/activity/58?locale=de');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Verdeckter Boss',
            $activity['name']
        );

        $client->request('GET', '/api/activity/75?locale=de');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'Schreibe das Unaussprechliche',
            $activity['name']
        );
    }

    public function testActivitySourceSimpleString()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/17');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://fairlygoodpractices.com/samolo.htm">Fairly good practices</a>',
            $activity['source']
        );

        $client->request('GET', '/api/activity/80');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.infoq.com/minibooks/agile-retrospectives-value">Luis Goncalves</a>',
            $activity['source']
        );
    }

    public function testActivitySourcePlaceholder()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/77');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="https://leanpub.com/ErfolgreicheRetrospektiven">Judith Andresen</a>',
            $activity['source']
        );

        $client->request('GET', '/api/activity/5');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $activity['source']
        );
    }

    public function testActivitySourcePlaceholderAndString()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/15');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.amazon.com/Agile-Retrospectives-Making-Teams-Great/dp/0977616649/">Agile Retrospectives</a> who took it from \'The Satir Model: Family Therapy and Beyond\'',
            $activity['source']
        );

        $client->request('GET', '/api/activity/37');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://www.amazon.com/Innovation-Games-Creating-Breakthrough-Collaborative/dp/0321437292/">Luke Hohmann</a>, found at <a href="http://www.ayeconference.com/appreciativeretrospective/">Diana Larsen</a>',
            $activity['source']
        );
    }

    public function testActivitySourceStringAndPlaceholder()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/14');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'ALE 2011, <a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $activity['source']
        );

        $client->request('GET', '/api/activity/65');
        $activity = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            '<a href="http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html">Doug Bradbury</a>, adapted for SW development by <a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $activity['source']
        );
    }

    public function testExpandedActivitySourceInCollectionRequests()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activities');
        $activities = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(
            'ALE 2011, <a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $activities[14 - 1]['source']
        );

        $this->assertEquals(
            '<a href="http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html">Doug Bradbury</a>, adapted for SW development by <a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $activities[65 - 1]['source']
        );
    }

    public function testActivityIdsAndNamesInCollectionRequestsEnglish()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activities');
        $activities = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(1, $activities[1 - 1]['retromatId']);
        $this->assertEquals(32, $activities[32 - 1]['retromatId']);
        $this->assertEquals(100, $activities[100 - 1]['retromatId']);

        $this->assertEquals('Emoticon Project Gauge', $activities[32 - 1]['name']);
        $this->assertEquals('Happiness Histogram', $activities[59 - 1]['name']);
        $this->assertEquals('Repeat &amp; Avoid', $activities[80 - 1]['name']);
    }

    public function testActivityIdsAndNamesInCollectionRequestsGerman()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activities?locale=de');
        $activities = \json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(1, $activities[1 - 1]['retromatId']);
        $this->assertEquals(32, $activities[32 - 1]['retromatId']);
        $this->assertEquals(75, $activities[75 - 1]['retromatId']);

        $this->assertEquals('Projekt-Gef&uuml;hlsmesser', $activities[32 - 1]['name']);
        $this->assertEquals('Verdeckter Boss', $activities[58 - 1]['name']);
        $this->assertEquals('Schreibe das Unaussprechliche', $activities[75 - 1]['name']);
    }

    public function testOnlyTranslatedActivitiesInCollectionRequests()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activities?locale=de');
        $activities = \json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(75, $activities);

        $client->request('GET', '/api/activities?locale=en');
        $activities = \json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(131, $activities);

        $client->request('GET', '/api/activities?locale=es');
        $activities = \json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(95, $activities);

        $client->request('GET', '/api/activities?locale=fr');
        $activities = \json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(50, $activities);

        $client->request('GET', '/api/activities?locale=nl');
        $activities = \json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(101, $activities);
    }

    public function testCachingHeadersSingleActivity()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/api/activity/59');
        $response = $client->getResponse();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);
    }

    public function testCachingHeadersForCollections()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        // Test English collection
        $client->request('GET', '/api/activities?locale=en');
        $response = $client->getResponse();
        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);

        // Test German collection
        $client->request('GET', '/api/activities?locale=de');
        $response = $client->getResponse();
        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);
    }
}
