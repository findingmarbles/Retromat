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
}