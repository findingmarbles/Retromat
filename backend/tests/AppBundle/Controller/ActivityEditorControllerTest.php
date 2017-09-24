<?php
declare(strict_types=1);

namespace tests\AppBundle\Controller;

require_once ('DataFixtures/LoadUsers.php');

use AppBundle\Entity\User;
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
//        $fixtures = $this->loadFixtures([
//            'tests\AppBundle\Controller\DataFixtures\LoadUsers'
//        ])->getReferenceRepository();

        $this->loadFixtures(['tests\AppBundle\Controller\DataFixtures\LoadUsers']);
//        $credentials = ['username' => 'admin', 'password' => 'adminPass'];


//        $admin = $fixtures->getReference('admin');
//        $this->loginAs($admin, 'main');

#        $client = $this->makeClient($credentials);


        $client = static::createClient();
        $crawler = $client->request('GET', '/en/login');
        $form = $crawler->selectButton('Log in')->form();
        $form->setValues(['_username' => 'admin', '_password' => 'adminPass']);
        $crawler = $client->submit($form);


        dump($client->getCookieJar());
        dump($client->getContainer()->get('session'));


        $crawler = $client->request('GET', '/en/team/activity/new');

        dump($client->getResponse()->getContent());

        $form = $crawler->selectButton('Create')->form();
        $form->setValues(
            [
                'appbundle_activity2[phase]' => 1,
                'appbundle_activity2[name]' => 'foo',
                'appbundle_activity2[summary]' => 'bar',
                'appbundle_activity2[desc]' => 'la',
            ]
        );
        $crawler = $client->submit($form);

        $this->assertStatusCode(302, $client);
        $this->assertEquals('http://localhost/en/team/activity/1', $crawler->selectLink('/en/team/activity/1')->link()->getUri());
    }
}
