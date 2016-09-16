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

    public function testHomeActionRendersSingleActivityBlock()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/?id=32');

        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(1, $activityBlocks->count());
    }

    public function testHomeActionRendersActivityTitles()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/?id=32');
        $this->assertEquals(
            'Emoticon Project Gauge',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_name')->text()
        );

        $crawler = $client->request('GET', '/?id=59');
        $this->assertEquals(
            'Happiness Histogram',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_name')->text()
        );
    }

    public function testHomeActionRendersActivitySummaries()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/?id=76');
        $this->assertEquals(
            'Participants express what they admire about one another',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_summary')->text()
        );

        $crawler = $client->request('GET', '/?id=81');
        $this->assertEquals(
            'Everyone states what they want out of the retrospective',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_summary')->text()
        );
    }
}