<?php
declare(strict_types=1);

namespace tests\AppBundle\Controller;

require_once('DataFixtures/LoadUsers.php');

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityEditorControllerTest extends WebTestCase
{
    public function setUp()
    {
        // empty database before each test.
        // any test that needs data to function has to specify the data needed explicitly.
        $this->loadFixtures([]);
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
}
