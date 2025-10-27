<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\AbstractTestCase;

class HomeControllerTest extends AbstractTestCase
{
    public function setUp(): void
    {
        $this->loadFixtures([]);
    }

    public function testShowSingleActivityBlock()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=32');

        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(1, $activityBlocks->count());
    }

    public function testShowActivityNameRawHtml()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=32');
        $this->assertEquals(
            'Emoticon Project Gauge',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_name')->html()
        );

        $crawler = $client->request('GET', '/en/?id=59');
        $this->assertEquals(
            'Happiness Histogram',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_name')->html()
        );

        $crawler = $client->request('GET', '/en/?id=80');
        $this->assertEquals(
            'Repeat &amp; Avoid', // raw HTML imported to DB from lang/activities_en.php
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_name')->html()
        );
    }

    public function testShowActivitySummaries()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=76');
        $this->assertEquals(
            'Participants express what they admire about one another',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_summary')->text()
        );

        $crawler = $client->request('GET', '/en/?id=81');
        $this->assertEquals(
            'Everyone states what they want out of the retrospective',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_summary')->text()
        );
    }

    public function testShowActivityDescriptionsRawHtml()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=22');
        $this->assertEquals(
            'Prepare a flipchart with a drawing of a thermometer from freezing to body temperature to hot. Each participant marks their mood on the sheet.',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_description')->html()
        );

        $crawler = $client->request('GET', '/en/?id=81');

        $expected = 'Everyone in the team states their goal for the retrospective, i.e. what they want out of the meeting. Examples of what participants might say: <ul><li>I\'m happy if we get 1 good action item</li>     <li>I want to talk about our argument about unit tests and agree on how we\'ll do it in the future</li>     <li>I\'ll consider this retro a success, if we come up with a plan to tidy up $obscureModule</li> </ul> [You can check if these goals were met if you close with activity #14.] <br><br> [The <a href="http://liveingreatness.com/additional-protocols/meet/">Meet - Core Protocol</a>, which inspired this activity, also describes \'Alignment Checks\': Whenever someone thinks the retrospective is not meeting people\'s needs they can ask for an Alignment Check. Then everyone says a number from 0 to 10 which reflects how much they are getting what they want. The person with the lowest number takes over to get nearer to what they want.]';

        $this->assertEquals(
            $expected,
            \str_replace("\n", '', $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_description')->html())
        );
    }

    public function testShowActivityLinksText()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1');
        $this->assertEquals(
            '1',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_id')->text()
        );

        $crawler = $client->request('GET', '/en/?id=2');
        $this->assertEquals(
            '2',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_id')->text()
        );
    }

    public function testShowActivityLinksHref()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1');
        $this->assertEquals(
            '?id=1',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_activity_link')->attr('href')
        );

        $crawler = $client->request('GET', '/en/?id=2');
        $this->assertEquals(
            '?id=2',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_activity_link')->attr('href')
        );
    }

    public function testShowActivityPhaseLinkText()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=3');

        $this->assertEquals(
            'Set the stage',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_phase_title')->text()
        );

        $crawler = $client->request('GET', '/en/?id=4');
        $this->assertEquals(
            'Gather data',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_phase_title')->text()
        );
    }

    public function testShowActivityPhaseLinkHref()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1');
        // .* in expression allows this to succeed on live data even when new activities are added
        $this->assertMatchesRegularExpression(
            '#\?id=1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-.*&phase=0#',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_phase_link')->attr('href')
        );

        $crawler = $client->request('GET', '/en/?id=5');
        // .* in expression allows this to succeed on live data even when new activities are added
        $this->assertMatchesRegularExpression(
            '#\?id=4-5-6-7-19-33-35-47-51-54-62-64-65-75-78-79-80-86-87-89-93-97-98-.*&phase=1#',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_phase_link')->attr('href')
        );
    }

    public function testShowActivitySourceSimpleStringRawHtml()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=17');
        $this->assertEquals(
            '<a href="http://fairlygoodpractices.com/samolo.htm">Fairly good practices</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );

        $crawler = $client->request('GET', '/en/?id=80');
        $this->assertEquals(
            '<a href="http://www.infoq.com/minibooks/agile-retrospectives-value">Luis Goncalves</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );
    }

    public function testShowActivitySourcePlaceholderRawHtml()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=77');
        $this->assertEquals(
            '<a href="https://leanpub.com/ErfolgreicheRetrospektiven">Judith Andresen</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );

        $crawler = $client->request('GET', '/en/?id=5');
        $this->assertEquals(
            '<a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );
    }

    public function testShowActivitySourcePlaceholderAndStringRawHtml()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=15');
        $this->assertEquals(
            '<a href="http://www.amazon.com/Agile-Retrospectives-Making-Teams-Great/dp/0977616649/">Agile Retrospectives</a> who took it from \'The Satir Model: Family Therapy and Beyond\'',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );

        $crawler = $client->request('GET', '/en/?id=37');
        $this->assertEquals(
            '<a href="http://www.amazon.com/Innovation-Games-Creating-Breakthrough-Collaborative/dp/0321437292/">Luke Hohmann</a>, found at <a href="http://www.ayeconference.com/appreciativeretrospective/">Diana Larsen</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );
    }

    public function testShowActivitySourceStringAndPlaceholderRawHtml()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=14');
        $this->assertEquals(
            'ALE 2011, <a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );

        $crawler = $client->request('GET', '/en/?id=65');
        $this->assertEquals(
            '<a href="http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html">Doug Bradbury</a>, adapted for SW development by <a href="http://www.finding-marbles.com/">Corinna Baldauf</a>',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_source')->html()
        );
    }

    public function testShowAny5Activities()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=3-87-113-13-16');
        $activities = $crawler->filter('.js_plan')->filter('.js_activity_block');
        $this->assertEquals(5, $activities->count());
        $this->assertEquals('3', $activities->eq(0)->filter('.js_fill_id')->text());
        $this->assertEquals('87', $activities->eq(1)->filter('.js_fill_id')->text());
        $this->assertEquals('113', $activities->eq(2)->filter('.js_fill_id')->text());
        $this->assertEquals('13', $activities->eq(3)->filter('.js_fill_id')->text());
        $this->assertEquals('16', $activities->eq(4)->filter('.js_fill_id')->text());

        $crawler = $client->request('GET', '/en/?id=1-91-2-55-100');
        $activities = $crawler->filter('.js_plan')->filter('.js_activity_block');
        $this->assertEquals(5, $activities->count());
        $this->assertEquals('1', $activities->eq(0)->filter('.js_fill_id')->text());
        $this->assertEquals('91', $activities->eq(1)->filter('.js_fill_id')->text());
        $this->assertEquals('2', $activities->eq(2)->filter('.js_fill_id')->text());
        $this->assertEquals('55', $activities->eq(3)->filter('.js_fill_id')->text());
        $this->assertEquals('100', $activities->eq(4)->filter('.js_fill_id')->text());
    }

    public function testShowSuccessiveActivitiesInDifferentColors()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1-2-3-4-5-6-7');

        $activities = $crawler->filter('.js_plan')->filter('.js_activity_block');
        $colorCode = $this->extractColorCode($activities->eq(0));
        for ($i = 1; $i < $activities->count(); ++$i) {
            $previousColorCode = $colorCode;
            $colorCode = $this->extractColorCode($activities->eq($i));

            $this->assertNotEquals($colorCode, $previousColorCode);
        }
    }

    /**
     * @return string
     */
    public function extractColorCode($activity)
    {
        $colorCodePrefix = ' bg';
        $classesString = $activity->attr('class');
        $colorCode = \substr($classesString, \strpos($classesString, $colorCodePrefix) + \strlen($colorCodePrefix), 1);

        return $colorCode;
    }

    public function testShowAllActivitiesInPhase0LongUrl()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0.'&phase=0');
        $ids = \explode('-', $idsStringPhase0);

        $activities = $crawler->filter('.js_plan')->filter('.js_activity_block');
        $this->assertEquals(\count($ids), $activities->count());
        $this->assertEquals('3', $activities->eq(2)->filter('.js_fill_id')->text());
        $this->assertEquals('18', $activities->eq(3)->filter('.js_fill_id')->text());
        $this->assertEquals('22', $activities->eq(4)->filter('.js_fill_id')->text());
        $this->assertEquals('122', $activities->eq(24)->filter('.js_fill_id')->text());
    }

    public function testShowTitlePhase0LongUrl()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0.'&phase=0');

        $this->assertEquals('All activities for SET THE STAGE', $crawler->filter('.js_fill_plan_title')->text());
    }

    public function testShowTitlePhase1LongUrl()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $idsStringPhase1 = '4-5-6-7-19-33-35-47-51-54-62-64-65-75-78-79-80-86-87-89-93-97-98-110-116-119-121-123';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase1.'&phase=1');

        $this->assertEquals('All activities for GATHER DATA', $crawler->filter('.js_fill_plan_title')->text());
    }

    public function testRegressionAvoidUnlessNeededHeaderAllActivitiesFor()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1-2-3&phase=0');

        $this->assertStringStartsWith('All activities for', $crawler->filter('.js_fill_plan_title')->text());

        $crawler = $client->request('GET', '/en/?id=1-2-3');

        $this->assertStringStartsNotWith('All activities for', $crawler->filter('.js_fill_plan_title')->text());
    }

    public function testHideSteppersPhase0LongUrl()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        // must not be hidden when phase is not specified in URL
        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0);
        $this->assertStringNotContainsString('hidden', $crawler->filter('.js_phase-stepper')->eq(0)->attr('class'));
        $this->assertStringNotContainsString('hidden', $crawler->filter('.js_phase-stepper')->eq(1)->attr('class'));
        // must be hidden when phase is specified in URL
        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0.'&phase=0');
        $this->assertStringContainsString('hidden', $crawler->filter('.js_phase-stepper')->eq(0)->attr('class'));
        $this->assertStringContainsString('hidden', $crawler->filter('.js_phase-stepper')->eq(1)->attr('class'));
    }

    public function testShowIdsInInputField()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1-2-3-4-5');
        $this->assertEquals('1-2-3-4-5', $crawler->filter('.ids-display__input')->attr('value'));

        $crawler = $client->request('GET', '/en/?id=3-87-113-13-16');
        $this->assertEquals('3-87-113-13-16', $crawler->filter('.ids-display__input')->attr('value'));
    }

    public function testShowPhaseStepperNextSingleActivity()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=3');
        $this->assertEquals(
            '?id=18',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_next_button_href')->attr('href')
        );
    }

    public function testShowPhaseStepperPreviousSingleActivity()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=18');
        $this->assertEquals(
            '?id=3',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_prev_button_href')->attr('href')
        );
    }

    public function testShowPhaseStepperNextMultipleActivities()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=3-87-113-13-16');
        $this->assertEquals(
            '?id=18-87-113-13-16',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_next_button_href')->attr('href')
        );

        $this->assertEquals(
            '?id=3-89-113-13-16',
            $crawler->filter('.js_activity_block')->eq(1)->filter('.js_next_button_href')->attr('href')
        );
    }

    public function testRedirectIndexToNewUrlEn()
    {
        $client = $this->getKernelBrowser();

        $client->request('GET', '/index.html?id=32');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect('/en/?id=32'),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testRedirectIndexToNewUrlDe()
    {
        $client = $this->getKernelBrowser();

        $client->request('GET', '/index_de.html?id=32');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect('/de/?id=32'),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testRedirectSlashToNewUrl()
    {
        $client = $this->getKernelBrowser();

        $client->request('GET', '/?id=70-4-69-29-71');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect('/en/?id=70-4-69-29-71'),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testRedirectPhase0ToNewUrl()
    {
        $client = $this->getKernelBrowser();

        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $client->request('GET', '/index.html?id='.$idsStringPhase0.'&phase=0');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect(
                '/en/?id=1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122&phase=0'
            ),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testShowPageTitle5ActivitiesEnglish()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=3-126-9-39-60');

        $this->assertStringEndsWith(' 3-126-9-39-60', $crawler->filter('title')->text());
    }

    public function testShowPageTitle5ActivitiesGerman()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/de/?id=3-126-9-39-60');

        $this->assertStringEndsWith(' 3-126-9-39-60', $crawler->filter('title')->text());
    }

    public function testShowPageTitle1ActivitiyEnglish()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1');

        $this->assertEquals('Retromat: ESVP (#1)', $crawler->filter('title')->text());
    }

    public function testShowPageTitle1ActivitiyGerman()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/de/?id=1');

        $this->assertEquals('Retromat: FEUG (engl. ESVP) (#1)', $crawler->filter('title')->text());
    }

    public function testShowMetaDescription5ActivitiesEnglish()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=3-126-9-39-60');

        $this->assertEquals(
            '3, 126: Give positive, as well as non-threatening, constructive feedback, 9: Team members brainstorm in 4 categories to quickly list issues, 39, 60',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    public function testShowMetaDescription5ActivitiesGerman()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/de/?id=1-2-3-4-5');

        $this->assertEquals(
            '1, 2: Die Teilnehmer markieren ihr Stimmungs-"Wetter" auf einem Flipchart., 3: Stelle eine Frage oder Aufgabe, die nacheinander von allen Teilnehmern beantwortet wird., 4, 5',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    public function testShowMetaDescription1ActivitiyEnglish()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=1');

        $this->assertEquals(
            'How do participants feel at the retro: Explorer, Shopper, Vacationer, or Prisoner?',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    public function testShowMetaDescription1ActivitiyGerman()
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/de/?id=1');

        $this->assertEquals(
            'Welche Haltung haben die Teilnehmer zur Retrospektive? In welcher Rolle fühlen sie sich? Forscher, Einkaufsbummler, Urlauber, Gefangener.',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    /**
     * @dataProvider malformedPathsProvider
     */
    public function test404OnIdNotFound($url)
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', $url);

        $this->assertEquals('404', $client->getResponse()->getStatusCode());
    }

    /** @small */
    public function testShowActivityCount()
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', '/en/?id=32');

        $optionsHtml = $crawler->filter('.header__languageswitcher')->filter('select')->html();

        $enlishCount = preg_replace('/(.*)English \((.*) activities(.*)/s', '\2', $optionsHtml);
        $this->assertEquals('131', $enlishCount);

        $germanCount = preg_replace('/(.*)Deutsch \((.*) Aktivitäten(.*)/s', '\2', $optionsHtml);
        $this->assertEquals('75', $germanCount);
    }

    /**
     * @return string[][]
     */
    public function malformedPathsProvider(): array
    {
        return [
            ['/en/?id=x'],
            ['/en/?id=03-07-22-90-132'],
            ['/en/?id=43-64-69-196-34'],
            ['/en/?id=122209988'],
            ['/en/?id=122376333-9-51-39-60'],
            ['/en/?id=10644-51-25-12496-14'],
            ['/en/?id=36-65-11389-12585-16'],
            ['/en/?id=622121121121212.1'],
            ['/en/?id=84-6-9-63-402121121121212.1'],
            ['/en/?id=3-64-37-99-772121121121212.1'],
            ['/nl/?id=59-7-10-13-71https%3A%2F%2Fwww.hartlooper.nl%2Fmovies%2F1013%2F17%2Fpechakucha_night_utrecht&voorstelling=26069'],
            ['/nl/?id=59-7-10-13-71https%3A%2F%2Fwww.hartlooper.nl%2Fmovies%2F1013%2F17%2Fpechakucha_night_utrecht&voorstelling=26069'],
            ['/en/?id=81999999.1%20union%20select%20unhex%28hex%28version%28%29%29%29%20-%20and%201%3D1'],
            ['/en/?id=76-97-74-72-60999999.1%2520union%2520select%2520unhex%28hex%28version%28%29%29%29%2520-%'],
            ['/fr/?id=%2Fetc%2Fpasswd'],
            ['/en/?id=%22%3Ehello'],
            ['/en/?id=%2Fetc%2Fpasswd'],
            ['/en/?id=..%2Fetc%2Fpasswd'],
            ['/en/?id=..%2F..%2F..%2Fetc%2Fpasswd'],
            ['/en/?id=..%2F..%2F..%2F..%2F..%2Fetc%2Fpasswd'],
            ['/en/?id=42-6-9-12-15999999.1%2520union%2520select%2520unhex%28hex%28version%28%29%29%29%2520-%2520and%25201%253D1'],
            ['/en/?id=1-65-94-24-40%20-%20Traduire%20cette%20page%27A%3D0'],
            ['/en/?id=8%3Faup-key%3Dc2fd9ed5efb0d253785cc4bfb806d0e2'],
            ['/en/?id=2-47-91-103-57%20-%20Traduire%20cette%20page%27A%3D0'],
            ['/en/?id=1-65-94-24-40%20-%20Traduire%20cette%20page%27A%3D0'],
            ['/en/?id=42-119-68-99-53%2520or%2520%281%2C2%29%3D%28select%2Afrom%28select%2520name_const%28CHAR%28111%2C108%2C111%2C108%2C111%2C115%2C104%2C101%2C114%29%2C1%29%2Cname_const%28CHAR%28111%2C108%2C111%2C108%2C111%2C115%2C104%2C101%2C114%29%2C1%29%29a%29%2520-%2520and%25201%253D1'],
            ['/en/?id=85-64-41-21-101999999.1%2520union%2520select%2520unhex%28hex%28version%28%29%29%29%2520-%2520and%25201%253D1'],
            ['/en/?id=18zhttps%3A%2F%2Fplans-for-retrospectives.com%2Fen%2F%3Fid%3D18'],
            ['/en/?id=94999999.1%20union%20select%20unhex%28hex%28version%28%29%29%29%20-%20and%201%3D1'],
            ['/en/?id=511111111111111%27%2520UNION%2520SELECT%2520CHAR%2845%2C120%2C49%2C45%2C81%2C45%29-%2520%2520'],
            ['/en/?id=511111111111111%2522%2520UNION%2520SELECT%2520CHAR%2845%2C120%2C49%2C45%2C81%2C45%29%2CCHAR%2845%2C120%2C50%2C45%2C81%2C45%29%2CCHAR%2845%2C120%2C51%2C45%2C81%2C45%29%2CCHAR%2845%2C120%2C52%2C45%2C81%2C45%29%2CCHAR%2845%2C120%2C53%2C45%2C81%2C45%29%2CCHAR%2845%2C120%2C54%2C45%2C81%2C45%29%2CCHAR%2845%2C120%2C55%2C45%2C81%2C45%29%2520-%2520%2F%2A%2520order%2520by%2520%2522as'],
        ];
    }

    // ===== COMPREHENSIVE TRANSLATION TESTS =====
    // Testing all $_lang elements to ensure they work during refactoring

    /**
     * @return array<int, list<string>>
     */
    public function allLanguagesProvider(): array
    {
        return [
            ['en'], ['de'], ['ru'], ['es'], ['fa'], ['fr'],
            ['nl'], ['ja'], ['pl'], ['pt-br'], ['zh'],
        ];
    }

    /**
     * @return array<int, list<string>>
     */
    public function coreTranslationKeysProvider(): array
    {
        return [
            ['HTML_TITLE'],
            ['INDEX_PITCH'],
            ['INDEX_PLAN_ID'],
            ['INDEX_RANDOM_RETRO'],
            ['INDEX_SEARCH_KEYWORD'],
            ['INDEX_ALL_ACTIVITIES'],
            ['INDEX_ABOUT'],
            ['INDEX_TEAM_CORINNA_TITLE'],
            ['INDEX_TEAM_CORINNA_TEXT'],
            ['INDEX_TEAM_TIMON_TITLE'],
            ['INDEX_TEAM_TIMON_TEXT'],
            ['ACTIVITY_SOURCE'],
            ['ACTIVITY_PREV'],
            ['ACTIVITY_NEXT'],
            ['ACTIVITY_PHOTO_VIEW_PHOTO'],
            ['ACTIVITY_PHOTO_VIEW_PHOTOS'],
            ['ACTIVITY_PHOTO_BY'],
            ['ERROR_MISSING_ACTIVITY'],
            ['POPUP_CLOSE'],
            ['POPUP_SEARCH_BUTTON'],
            ['POPUP_SEARCH_INFO'],
            ['POPUP_SEARCH_NO_RESULTS'],
        ];
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testPageTitleContainsTranslatedTitle(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $titleText = $crawler->filter('title')->text();

        // Title should contain "Retromat - " followed by translated title
        $this->assertStringStartsWith('Retromat - ', $titleText);
        $this->assertNotEquals('Retromat - ', $titleText); // Should have actual translated content
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testPitchSectionContainsTranslatedContent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $pitchText = $crawler->filter('.pitch .content .inner')->html();

        // Pitch should contain translated content about retrospectives
        $this->assertNotEmpty($pitchText);
        $this->assertGreaterThan(50, strlen($pitchText)); // Should be substantial content

        // Check for retrospective word in various languages
        $retrospectiveWords = ['retrospective', 'retrospectiva', 'rétrospective', 'ретроспективу', 'retrospektive', 'retrospektif'];
        $found = false;
        foreach ($retrospectiveWords as $word) {
            if (false !== stripos($pitchText, $word)) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, "Pitch should contain a retrospective-related word in language {$language}");
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testPlanIdLabelPresent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $planIdText = $crawler->filter('.ids-display')->text();

        // Plan ID section should contain translated label
        $this->assertNotEmpty($planIdText);
        $this->assertStringContainsStringIgnoringCase('id', $planIdText);
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testRandomRetroButtonPresent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $randomButtonText = $crawler->filter('.plan-navi__random')->text();

        // Random button should contain translated text
        $this->assertNotEmpty($randomButtonText);
        $this->assertGreaterThan(5, strlen($randomButtonText)); // Should be more than just "Random"
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testSearchButtonPresent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $searchButtonText = $crawler->filter('.plan-navi__search')->text();

        // Search button should contain translated text
        $this->assertNotEmpty($searchButtonText);
        $this->assertGreaterThan(5, strlen($searchButtonText)); // Should be more than just "Search"
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testAboutSectionPresent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $aboutText = $crawler->filter('.about .content .inner')->html();

        // About section should contain translated content with activity count placeholders
        $this->assertNotEmpty($aboutText);
        $this->assertStringContainsString('js_footer_no_of_activities', $aboutText);
        $this->assertStringContainsString('js_footer_no_of_combinations', $aboutText);
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testCorinnaSectionPresent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $teamMembers = $crawler->filter('.team-member');

        // Should have team members including Corinna
        $this->assertGreaterThan(0, $teamMembers->count());

        // Find Corinna's section
        $corinnaFound = false;
        $teamMembers->each(function ($node) use (&$corinnaFound) {
            if (false !== strpos($node->text(), 'Corinna')) {
                $corinnaFound = true;
            }
        });

        $this->assertTrue($corinnaFound, 'Corinna team member section should be present');
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testTimonSectionPresent(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $teamMembers = $crawler->filter('.team-member');

        // Find Timon's section
        $timonFound = false;
        $teamMembers->each(function ($node) use (&$timonFound) {
            if (false !== strpos($node->text(), 'Timon')) {
                $timonFound = true;
            }
        });

        $this->assertTrue($timonFound, 'Timon team member section should be present');
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testJavaScriptTranslationsEmbedded(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $html = $crawler->html();

        // JavaScript should contain translated error messages embedded in the HTML
        // Check for common error patterns that should be translated
        $this->assertStringContainsString('alert(', $html); // Should have JavaScript alert functions
        $this->assertStringContainsString('function publish_plan', $html); // Should have JS functions
        $this->assertStringContainsString('function get_activity_array', $html); // Should have JS functions
        $this->assertStringContainsString('function get_photo_string', $html); // Should have JS functions
        $this->assertStringContainsString('function publish_activities_for_keywords', $html); // Should have JS functions

        // Check for specific translated content patterns
        if ('en' === $language) {
            $this->assertStringContainsString('can\'t find activity with ID', $html);
            $this->assertStringContainsString('Photo by', $html);
            $this->assertStringContainsString('View photo', $html);
        } elseif ('de' === $language) {
            $this->assertStringContainsString('kann keine Aktivit&auml;t mit dieser ID finden', $html);
            $this->assertStringContainsString('Foto von', $html);
            $this->assertStringContainsString('Foto ansehen', $html);
        }
        // For other languages, just check that there's substantial JavaScript content
        else {
            $this->assertGreaterThan(1000, strlen($html)); // Should be substantial content
        }
    }

    /**
     * Test that translator sections are handled correctly per language.
     *
     * IMPORTANT: This test expects the CURRENT SPECIFIC BEHAVIOR of the translation system.
     *
     * === EXPECTED BEHAVIOR ===
     * Each language should display translator information based on its language file's
     * $_lang['INDEX_TEAM_TRANSLATOR_*'] arrays. Languages with no translators should show
     * no translator section, while languages with translators should show their contributors.
     *
     * === CURRENT SPECIFIC BEHAVIOR ===
     * Based on analysis of the language files, the current translator counts are:
     * - English: 0 translators (base language, no translation needed)
     * - German: 2 translators (Corinna + 1 additional)
     * - Russian: 3 translators (most contributors)
     * - French: 2 translators
     * - Spanish: 2 translators (Thomas Wallet and Pedro Serrano)
     * - Polish: 1 translator
     * - Dutch: 1 translator
     * - Chinese: 1 translator
     * - Japanese: 1 translator
     * - Persian: 1 translator
     * - Portuguese-Brazilian: 1 translator (template "Your Name")
     *
     * === TEST RATIONALE ===
     * This test documents the current translator attribution state and ensures it remains
     * consistent during refactoring. The variation in translator counts reflects the real
     * contribution history and isn't necessarily inconsistent behavior - it's just specific
     * to each language's translation community.
     *
     * === REFACTORING IMPLICATIONS ===
     * When the $_lang system is refactored, this test may need updates if:
     * - New translators are added to any language
     * - The translator array structure changes
     * - The template rendering logic for translator sections changes
     *
     * @dataProvider allLanguagesProvider
     */
    public function testTranslatorSectionHandling(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");
        $teamMembers = $crawler->filter('.team-member');

        // Expected translator counts per language (based on language file analysis)
        $expectedTranslatorCounts = [
            'en' => 0,   // English has no translator section
            'de' => 2,   // German has 2 translators
            'ru' => 3,   // Russian has 3 translators
            'fr' => 2,   // French has 2 translators
            'es' => 2,   // Spanish has 2 translators (Thomas Wallet and Pedro Serrano)
            'pl' => 1,   // Polish has 1 translator
            'nl' => 1,   // Dutch has 1 translator
            'zh' => 1,   // Chinese has 1 translator
            'ja' => 1,   // Japanese has 1 translator
            'fa' => 1,   // Persian has 1 translator
            'pt-br' => 1, // Portuguese-Brazilian has 1 translator (template "Your Name")
        ];

        $expectedCount = $expectedTranslatorCounts[$language] ?? 0;

        // Count actual translators (excluding Corinna and Timon)
        $translatorCount = 0;
        $teamMembers->each(function ($node) use (&$translatorCount) {
            $text = $node->text();
            if (false === strpos($text, 'Corinna') && false === strpos($text, 'Timon')) {
                ++$translatorCount;
            }
        });

        $this->assertEquals(
            $expectedCount,
            $translatorCount,
            "Language {$language} should have {$expectedCount} translator(s), found {$translatorCount}"
        );
    }

    /**
     * Test activity navigation tooltips across all languages.
     *
     * IMPORTANT: This test expects the CURRENT INCONSISTENT BEHAVIOR, not the ideal behavior.
     *
     * === EXPECTED BEHAVIOR ===
     * All languages should show their translated tooltips from $_lang['ACTIVITY_PREV'] and $_lang['ACTIVITY_NEXT'].
     * For example:
     * - English: "Show other activity for this phase"
     * - German: "Zeige eine andere Aktivität für diese Phase"
     * - Russian: "Показать предыдущую/следующую активность для этой фазы"
     *
     * === CURRENT INCONSISTENT BEHAVIOR ===
     * The system has translation issues in the template compilation process:
     *
     * 1. **English, German, Russian**: Show English defaults ("Previous"/"Next") instead of their
     *    translated tooltips. This suggests the PHP template compilation isn't properly embedding
     *    the $_lang values for these languages.
     *
     * 2. **8 other languages** (es, fr, nl, ja, pl, pt-br, zh): Show properly translated tooltips
     *    as expected, indicating the template compilation works correctly for these languages.
     *
     * 3. **Persian (fa)**: Shows German tooltips instead of Persian ones, suggesting a cross-language
     *    contamination issue in the template compilation process.
     *
     * === TEST ADAPTATION ===
     * Rather than testing the ideal behavior, this test documents and expects the current broken
     * state to ensure the test suite is green before refactoring. Each language has specific
     * expected values based on what the system actually outputs today.
     *
     * === REFACTORING IMPLICATIONS ===
     * When the $_lang translation system is refactored, this test will need to be updated to
     * expect consistent translated tooltips across all languages. The inconsistencies revealed
     * here indicate problems with:
     * - Template compilation for en/de/ru languages
     * - Language file loading/processing for Persian
     * - General translation embedding in the PHP->Twig conversion process
     *
     * @dataProvider allLanguagesProvider
     */
    public function testActivityTooltipsTranslated(string $language): void
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/?id=1");

        // Check for activity navigation tooltips
        $prevButton = $crawler->filter('.js_prev_button_href');
        $nextButton = $crawler->filter('.js_next_button_href');

        // Expected tooltip values based on current system behavior
        $expectedTooltips = [
            'en' => ['prev' => 'Previous', 'next' => 'Next'],
            'de' => ['prev' => 'Previous', 'next' => 'Next'],
            'ru' => ['prev' => 'Previous', 'next' => 'Next'],
            'es' => ['prev' => 'Mostrar otra actividad para esta fase', 'next' => 'Mostrar otra actividad para esta fase'],
            'fa' => ['prev' => 'Zeige eine andere Aktivität für diese Phase', 'next' => 'Zeige eine andere Aktivität für diese Phase'],
            'fr' => ['prev' => 'Afficher une autre activité pour cette phase', 'next' => 'Afficher une autre activité pour cette phase'],
            'nl' => ['prev' => 'Toon een andere activiteit voor deze fase', 'next' => 'Toon een andere activiteit voor deze fase'],
            'ja' => ['prev' => 'このフェーズの他のアクティビティを表示', 'next' => 'このフェーズの他のアクティビティを表示'],
            'pl' => ['prev' => 'Pokaż poprzednią aktywność', 'next' => 'Pokaż następną aktywność'],
            'pt-br' => ['prev' => 'Show other activity for this phase', 'next' => 'Show other activity for this phase'],
            'zh' => ['prev' => '显示该阶段的其他活动', 'next' => '显示该阶段的其他活动'],
        ];

        if ($prevButton->count() > 0) {
            $prevTitle = $prevButton->attr('title');
            $this->assertNotEmpty($prevTitle);
            $this->assertEquals($expectedTooltips[$language]['prev'], $prevTitle);
        }

        if ($nextButton->count() > 0) {
            $nextTitle = $nextButton->attr('title');
            $this->assertNotEmpty($nextTitle);
            $this->assertEquals($expectedTooltips[$language]['next'], $nextTitle);
        }
    }

    /**
     * @dataProvider allLanguagesProvider
     */
    public function testPopupElementsTranslated(string $language): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $crawler = $client->request('GET', "/{$language}/");

        // Check search popup elements
        $searchButton = $crawler->filter('.popup__submit');
        $closeLink = $crawler->filter('.popup__close-link');
        $searchInfo = $crawler->filter('.popup__info');

        if ($searchButton->count() > 0) {
            $this->assertNotEmpty($searchButton->attr('value'));
        }

        if ($closeLink->count() > 0) {
            $this->assertNotEmpty($closeLink->text());
        }

        if ($searchInfo->count() > 0) {
            $this->assertNotEmpty($searchInfo->text());
        }
    }

    public function testCachingHeadersSingleActivity(): void
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/en/?id=32');
        $response = $client->getResponse();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);

        $client->request('GET', '/de/?id=16');
        $response = $client->getResponse();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);
    }

    public function testCachingHeadersMultipleActivities(): void
    {
        $this->markTestSkipped('IDs from query strings are intentionally ignored to reduce AI crawler load.');
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        $client->request('GET', '/en/?id=32-3-87-113-13');
        $response = $client->getResponse();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);

        $client->request('GET', '/de/?id=70-4-69-29-71');
        $response = $client->getResponse();

        $cacheControl = $response->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $cacheControl);
        $this->assertStringContainsString('s-maxage=84600', $cacheControl);
        $this->assertStringContainsString('max-age=3600', $cacheControl);
    }

    public function testCountActivitiesWithValidLocales(): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        // Make a request to trigger the countActivities method through homeAction
        $crawler = $client->request('GET', '/en/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // The method is called internally and should not throw any exceptions
        $this->assertSelectorExists('body');
    }

    public function testCountActivitiesWithEmptyDatabase(): void
    {
        // Load no fixtures to test with empty database
        $client = $this->getKernelBrowser();

        // Make a request to trigger the countActivities method
        $crawler = $client->request('GET', '/en/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // Should handle empty database gracefully
        $this->assertSelectorExists('body');
    }

    public function testCountActivitiesWithMultipleLocales(): void
    {
        $this->loadFixtures(['App\Tests\Controller\DataFixtures\LoadActivityData']);
        $client = $this->getKernelBrowser();

        // Test different locales to ensure countActivities works for all
        $locales = ['en', 'de'];

        foreach ($locales as $locale) {
            $crawler = $client->request('GET', "/{$locale}/");
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
            $this->assertSelectorExists('body');
        }
    }
}
