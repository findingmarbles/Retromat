<?php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomeActionRenders5ActivitiesForStaticHtmlExamplePlan()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/?id=3-87-113-13-16');

        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(5, $activityBlocks->count());
    }

    public function testHomeActionRendersActivityTitle()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/?id=32');

        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(1, $activityBlocks->count());
        $this->assertEquals('Emoticon Project Gauge', $activityBlocks->eq(0)->filter('.js_fill_name')->text());
    }

    public function testHomeActionRendersActivityTitles()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/?id=32');
        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(1, $activityBlocks->count());
        $this->assertEquals('Emoticon Project Gauge', $activityBlocks->eq(0)->filter('.js_fill_name')->text());

        $crawler = $client->request('GET', '/?id=59');
        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(1, $activityBlocks->count());
        $this->assertEquals('Happiness Histogram', $activityBlocks->eq(0)->filter('.js_fill_name')->text());
    }
}