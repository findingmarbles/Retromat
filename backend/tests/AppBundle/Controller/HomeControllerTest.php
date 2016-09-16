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


    public function testHomeActionRendersActivityDescriptions()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/?id=22');
        $this->assertEquals(
            'Prepare a flipchart with a drawing of a thermometer from freezing to body temperature to hot. Each participant marks their mood on the sheet.',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_description')->text()
        );

        $crawler = $client->request('GET', '/?id=81');
        $this->assertEquals(
            'Everyone in the team states their goal for the retrospective, i.e. what they want out of the meeting. Examples of what participants might say: <ul>     <li>I\'m happy if we get 1 good action item</li>     <li>I want to talk about our argument about unit tests and agree on how we\'ll do it in the future</li>     <li>I\'ll consider this retro a success, if we come up with a plan to tidy up $obscureModule</li> </ul> [You can check if these goals were met if you close with activity #14.] <br><br> [The <a href="http://liveingreatness.com/additional-protocols/meet/">Meet - Core Protocol</a>, which inspired this activity, also describes \'Alignment Checks\': Whenever someone thinks the retrospective is not meeting people\'s needs they can ask for an Alignment Check. Then everyone says a number from 0 to 10 which reflects how much they are getting what they want. The person with the lowest number takes over to get nearer to what they want.]',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_description')->text()
        );
    }

    public function testHomeActionRendersActivityLinks()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/?id=1');
        $this->assertEquals(
            '1',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_id')->text()
        );

        $crawler = $client->request('GET', '/?id=2');
        $this->assertEquals(
            '2',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_id')->text()
        );
    }
}