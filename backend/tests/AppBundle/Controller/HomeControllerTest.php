<?php
declare(strict_types = 1);

namespace tests\AppBundle\Controller;

// tests directory is not available to the autoloader, so we have to manually require these files:
require_once 'DataFixtures/LoadActivityData.php';

use Liip\FunctionalTestBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function setUp()
    {
        // empty database before each test.
        // any test that needs data to function has to specify the data needed explicitly.
        $this->loadFixtures([]);
    }

    public function testShowSingleActivityBlock()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=32');

        $jsPlan = $crawler->filter('.js_plan');
        $activityBlocks = $jsPlan->filter('.js_activity_block');
        $this->assertEquals(1, $activityBlocks->count());
    }

    public function testShowActivityNameRawHtml()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=22');
        $this->assertEquals(
            'Prepare a flipchart with a drawing of a thermometer from freezing to body temperature to hot. Each participant marks their mood on the sheet.',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_description')->html()
        );

        $crawler = $client->request('GET', '/en/?id=81');

        $expected = 'Everyone in the team states their goal for the retrospective, i.e. what they want out of the meeting. Examples of what participants might say: <ul><li>I\'m happy if we get 1 good action item</li>     <li>I want to talk about our argument about unit tests and agree on how we\'ll do it in the future</li>     <li>I\'ll consider this retro a success, if we come up with a plan to tidy up $obscureModule</li> </ul> [You can check if these goals were met if you close with activity #14.] <br><br> [The <a href="http://liveingreatness.com/additional-protocols/meet/">Meet - Core Protocol</a>, which inspired this activity, also describes \'Alignment Checks\': Whenever someone thinks the retrospective is not meeting people\'s needs they can ask for an Alignment Check. Then everyone says a number from 0 to 10 which reflects how much they are getting what they want. The person with the lowest number takes over to get nearer to what they want.]';

        $this->assertEquals(
            $expected,
            str_replace("\n", '', $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_description')->html())
        );
    }

    public function testShowActivityLinksText()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=1');
        // .* in expression allows this to succeed on live data even when new activities are added
        $this->assertRegExp(
            '#\?id=1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-.*&phase=0#',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_phase_link')->attr('href')
        );

        $crawler = $client->request('GET', '/en/?id=5');
        // .* in expression allows this to succeed on live data even when new activities are added
        $this->assertRegExp(
            '#\?id=4-5-6-7-19-33-35-47-51-54-62-64-65-75-78-79-80-86-87-89-93-97-98-.*&phase=1#',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_fill_phase_link')->attr('href')
        );
    }

    public function testShowActivitySourceSimpleStringRawHtml()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=1-2-3-4-5-6-7');

        $activities = $crawler->filter('.js_plan')->filter('.js_activity_block');
        $colorCode = $this->extractColorCode($activities->eq(0));
        for ($i = 1; $i < $activities->count(); $i++) {
            $previousColorCode = $colorCode;
            $colorCode = $this->extractColorCode($activities->eq($i));

            $this->assertNotEquals($colorCode, $previousColorCode);
        }
    }

    /**
     * @param $activity
     * @return string
     */
    public function extractColorCode($activity)
    {
        $colorCodePrefix = ' bg';
        $classesString = $activity->attr('class');
        $colorCode = substr($classesString, strpos($classesString, $colorCodePrefix) + strlen($colorCodePrefix), 1);

        return $colorCode;
    }

    public function testShowAllActivitiesInPhase0LongUrl()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0.'&phase=0');
        $ids = explode('-', $idsStringPhase0);

        $activities = $crawler->filter('.js_plan')->filter('.js_activity_block');
        $this->assertEquals(count($ids), $activities->count());
        $this->assertEquals('3', $activities->eq(2)->filter('.js_fill_id')->text());
        $this->assertEquals('18', $activities->eq(3)->filter('.js_fill_id')->text());
        $this->assertEquals('22', $activities->eq(4)->filter('.js_fill_id')->text());
        $this->assertEquals('122', $activities->eq(24)->filter('.js_fill_id')->text());
    }

    public function testShowTitlePhase0LongUrl()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0.'&phase=0');

        $this->assertEquals('All activities for SET THE STAGE', $crawler->filter('.js_fill_plan_title')->text());
    }

    public function testShowTitlePhase1LongUrl()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $idsStringPhase1 = '4-5-6-7-19-33-35-47-51-54-62-64-65-75-78-79-80-86-87-89-93-97-98-110-116-119-121-123';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase1.'&phase=1');

        $this->assertEquals('All activities for GATHER DATA', $crawler->filter('.js_fill_plan_title')->text());
    }

    public function testRegressionAvoidUnlessNeededHeaderAllActivitiesFor()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=1-2-3&phase=0');

        $this->assertStringStartsWith('All activities for', $crawler->filter('.js_fill_plan_title')->text());

        $crawler = $client->request('GET', '/en/?id=1-2-3');

        $this->assertStringStartsNotWith('All activities for', $crawler->filter('.js_fill_plan_title')->text());
    }

    public function testHideSteppersPhase0LongUrl()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        // must not be hidden when phase is not specified in URL
        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0);
        $this->assertNotContains('hidden', $crawler->filter('.js_phase-stepper')->eq(0)->attr('class'));
        $this->assertNotContains('hidden', $crawler->filter('.js_phase-stepper')->eq(1)->attr('class'));

        // must be hidden when phase is specified in URL
        $idsStringPhase0 = '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122';
        $crawler = $client->request('GET', '/en/?id='.$idsStringPhase0.'&phase=0');
        $this->assertContains('hidden', $crawler->filter('.js_phase-stepper')->eq(0)->attr('class'));
        $this->assertContains('hidden', $crawler->filter('.js_phase-stepper')->eq(1)->attr('class'));
    }

    public function testShowNumbersInFooter()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=3-87-113-13-16');

        $footer = $crawler->filter('.about')->filter('.content');
        $this->assertEquals('127', $footer->filter('.js_footer_no_of_activities')->text());
        $this->assertEquals('8349005', $footer->filter('.js_footer_no_of_combinations')->text());
        $this->assertEquals('25x30x22x22x23+5', $footer->filter('.js_footer_no_of_combinations_formula')->text());
    }

    public function testShowRandomPlanLinksOnHome()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/');

        $this->assertEquals(
            'Is loading taking too long? Here are some random plans:',
            $crawler->filter('.js_fill_summary')->text()
        );
    }

    public function testShowIdsInInputField()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=1-2-3-4-5');
        $this->assertEquals('1-2-3-4-5', $crawler->filter('.ids-display__input')->attr('value'));

        $crawler = $client->request('GET', '/en/?id=3-87-113-13-16');
        $this->assertEquals('3-87-113-13-16', $crawler->filter('.ids-display__input')->attr('value'));
    }

    public function testShowPhaseStepperNextSingleActivity()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=3');
        $this->assertEquals(
            '?id=18',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_next_button')->attr('href')
        );
    }

    public function testShowPhaseStepperPreviousSingleActivity()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=18');
        $this->assertEquals(
            '?id=3',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_prev_button')->attr('href')
        );
    }

    public function testShowPhaseStepperNextMultipleActivities()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=3-87-113-13-16');
        $this->assertEquals(
            '?id=18-87-113-13-16',
            $crawler->filter('.js_activity_block')->eq(0)->filter('.js_next_button')->attr('href')
        );

        $this->assertEquals(
            '?id=3-89-113-13-16',
            $crawler->filter('.js_activity_block')->eq(1)->filter('.js_next_button')->attr('href')
        );
    }

    public function testRedirectIndexToNewUrlEn()
    {
        $client = static::createClient();

        $client->request('GET', '/index.html?id=32');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect('/en/?id=32'),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testRedirectIndexToNewUrlDe()
    {
        $client = static::createClient();

        $client->request('GET', '/index_de.html?id=32');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect('/de/?id=32'),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testRedirectSlashToNewUrl()
    {
        $client = static::createClient();

        $client->request('GET', '/?id=70-4-69-29-71');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->isRedirect('/en/?id=70-4-69-29-71'),
            'Response is a redirect to the correct new URL.'
        );
    }

    public function testRedirectPhase0ToNewUrl()
    {
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=3-126-9-39-60');

        $this->assertStringEndsWith(' 3-126-9-39-60', $crawler->filter('title')->text());
    }

    public function testShowPageTitle5ActivitiesGerman()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/de/?id=3-126-9-39-60');

        $this->assertStringEndsWith(' 3-126-9-39-60', $crawler->filter('title')->text());
    }

    public function testShowPageTitle1ActivitiyEnglish()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=1');

        $this->assertEquals('Retromat: ESVP (#1)', $crawler->filter('title')->text());
    }

    public function testShowPageTitle1ActivitiyGerman()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/de/?id=1');

        $this->assertEquals('Retromat: FEUG (engl. ESVP) (#1)', $crawler->filter('title')->text());
    }

    public function testShowMetaDescription5ActivitiesEnglish()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=3-126-9-39-60');

        $this->assertEquals(
            '3, 126: Give positive, as well as non-threatening, constructive feedback, 9: Team members brainstorm in 4 categories to quickly list issues, 39, 60',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    public function testShowMetaDescription5ActivitiesGerman()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/de/?id=1-2-3-4-5');

        $this->assertEquals(
            '1, 2: Die Teilnehmer markieren ihr Stimmungs-"Wetter" auf einem Flipchart., 3: Stelle eine Frage oder Aufgabe, die nacheinander von allen Teilnehmern beantwortet wird., 4, 5',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    public function testShowMetaDescription1ActivitiyEnglish()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/?id=1');

        $this->assertEquals(
            'How do participants feel at the retro: Explorer, Shopper, Vacationer, or Prisoner?',
            $crawler->filter('meta[name="description"]')->attr('content')
        );
    }

    public function testShowMetaDescription1ActivitiyGerman()
    {
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

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
        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadActivityData']);
        $client = static::createClient();

        $client->request('GET', $url);

        $this->assertEquals('404', $client->getResponse()->getStatusCode());
    }

    public function malformedPathsProvider()
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
}