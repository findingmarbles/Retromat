<?php
declare(strict_types=1);

namespace tests\AppBundle\Controller;

require_once('DataFixtures/LoadUsers.php');
require_once('DataFixtures/LoadActivityData.php');

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityEditorControllerTest extends WebTestCase
{
    public function setUp()
    {
        // empty database before each test.
        // any test that needs data to function has to specify the data needed explicitly.
        $this->loadFixtures([]);
    }

    public function testCreateNewActivityUsesNextFreeRetromatIdEmptyDb()
    {
        $refRepo = $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadUsers'])->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $prefilledRetromatId = $crawler->filter('#appbundle_activity2_retromatId')->eq(0)->attr('value');

        $this->assertEquals(1, $prefilledRetromatId);
    }

    public function testCreateNewActivityUsesNextFreeRetromatIdFullDb()
    {
        $refRepo = $this->loadFixtures(
            [
                'tests\AppBundle\Controller\DataFixtures\LoadActivityData',
                'tests\AppBundle\Controller\DataFixtures\LoadUsers',
            ]
        )->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $prefilledRetromatId = $crawler->filter('#appbundle_activity2_retromatId')->eq(0)->attr('value');

        $this->assertEquals(132, $prefilledRetromatId);
    }

    public function testCreateNewActivityPhase1()
    {
        $refRepo = $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadUsers'])->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton('Create')->form()->setValues(
            [
                'appbundle_activity2[phase]' => 1,
                'appbundle_activity2[name]' => 'foo',
                'appbundle_activity2[summary]' => 'bar',
                'appbundle_activity2[desc]' => 'la',
            ]
        );
        $crawler = $client->submit($form);

        $this->assertStatusCode(302, $client);
        $this->assertEquals(
            'http://localhost/en/team/activity/1',
            $crawler->selectLink('/en/team/activity/1')->link()->getUri()
        );
    }

    public function testCreateNewActivityPhase0()
    {
        $refRepo = $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadUsers'])->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton('Create')->form()->setValues(
            [
                'appbundle_activity2[phase]' => 0,
                'appbundle_activity2[name]' => 'foo',
                'appbundle_activity2[summary]' => 'bar',
                'appbundle_activity2[desc]' => 'la',
            ]
        );
        $crawler = $client->submit($form);

        $this->assertStatusCode(302, $client);
        $this->assertEquals(
            'http://localhost/en/team/activity/1',
            $crawler->selectLink('/en/team/activity/1')->link()->getUri()
        );
    }

    public function testCreateNewActivityMultipe()
    {
        $refRepo = $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadUsers'])->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton('Create')->form()->setValues(
            [
                'appbundle_activity2[phase]' => 1,
                'appbundle_activity2[name]' => 'foo',
                'appbundle_activity2[summary]' => 'bar',
                'appbundle_activity2[desc]' => 'la',
            ]
        );
        $crawler = $client->submit($form);

        $this->assertStatusCode(302, $client);
        $this->assertEquals(
            'http://localhost/en/team/activity/1',
            $crawler->selectLink('/en/team/activity/1')->link()->getUri()
        );

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton('Create')->form()->setValues(
            [
                'appbundle_activity2[phase]' => 2,
                'appbundle_activity2[name]' => 'qq',
                'appbundle_activity2[summary]' => 'ww',
                'appbundle_activity2[desc]' => 'ee',
            ]
        );
        $crawler = $client->submit($form);

        $this->assertStatusCode(302, $client);
        $this->assertEquals(
            'http://localhost/en/team/activity/2',
            $crawler->selectLink('/en/team/activity/2')->link()->getUri()
        );
    }

    public function testIndexContainsOnlyTranslatedActivities()
    {
        $refRepo = $this->loadFixtures(
            [
                'tests\AppBundle\Controller\DataFixtures\LoadActivityData',
                'tests\AppBundle\Controller\DataFixtures\LoadUsers',
            ]
        )->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/de/team/activity/');
        $this->assertCount(75+1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/en/team/activity/');
        $this->assertCount(131+1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/es/team/activity/');
        $this->assertCount(95+1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/fr/team/activity/');
        $this->assertCount(50+1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/nl/team/activity/');
        $this->assertCount(101+1, $crawler->filter('tr'));
    }

    public function testCreateNewActivityTranslationDeForCorrectId()
    {
        $refRepo = $this->loadFixtures(
            [
                'tests\AppBundle\Controller\DataFixtures\LoadActivityData',
                'tests\AppBundle\Controller\DataFixtures\LoadUsers',
            ]
        )->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/de/team/activity/new');
        $this->assertEquals(75+1, $crawler->filter('#appbundle_activity2_retromatId')->attr('value'));
    }

    public function testCreateNewActivityTranslationDeFormOnlyShowsTranslatableFields()
    {
        $refRepo = $this->loadFixtures(
            [
                'tests\AppBundle\Controller\DataFixtures\LoadActivityData',
                'tests\AppBundle\Controller\DataFixtures\LoadUsers',
            ]
        )->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/de/team/activity/new');

        $formValues = $crawler->selectButton('Create')->form()->getPhpValues();
        $translatableFields = ['name', 'summary', 'desc', '_token'];
        $this->assertEquals($translatableFields, array_keys($formValues['appbundle_activity2']));
    }

    public function testCreateNewActivityTranslationDe()
    {
        $refRepo = $this->loadFixtures(
            [
                'tests\AppBundle\Controller\DataFixtures\LoadActivityData',
                'tests\AppBundle\Controller\DataFixtures\LoadUsers',
            ]
        )->getReferenceRepository();
        $this->loginAs($refRepo->getReference('admin'), 'main');
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/de/team/activity/new');
        $form = $crawler->selectButton('Create')->form()->setValues(
            [
                'appbundle_activity2[name]' => 'foo',
                'appbundle_activity2[summary]' => 'bar',
                'appbundle_activity2[desc]' => 'la',
            ]
        );
        $crawler = $client->submit($form);

        $this->assertStatusCode(302, $client);
        $this->assertEquals(
            'http://localhost/de/team/activity/'.(75+1),
            $crawler->selectLink('/de/team/activity/'.(75+1))->link()->getUri()
        );

    }
}
