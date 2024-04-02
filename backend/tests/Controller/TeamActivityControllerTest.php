<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\AbstractTestCase;
use App\Tests\Controller\DataFixtures\LoadUsers;
use Symfony\Bundle\FrameworkBundle\KernelBrowser as Client;
use Symfony\Component\HttpFoundation\Response;

class TeamActivityControllerTest extends AbstractTestCase
{
    private const SELECTOR_BUTTON_PRIMARY = 'Save';

    public function setUp(): void
    {
        $this->loadFixtures([]);
    }

    public function testCreateNewActivityUsesNextFreeRetromatIdEmptyDb(): void
    {
        $client = $this->makeClientLoginAdmin();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $prefilledRetromatId = $crawler->filter('#app_activity_retromatId')->eq(0)->attr('value');

        $this->assertEquals(1, $prefilledRetromatId);
    }

    /** @medium */
    public function testCreateNewActivityUsesNextFreeRetromatIdFullDb()
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        // WTF? When running in Docker, this fails, but when sleeping 1 s it succeeds.
        sleep(1);

        $crawler = $client->request('GET', '/en/team/activity/new');
        $prefilledRetromatId = $crawler->filter('#app_activity_retromatId')->eq(0)->attr('value');

        $this->assertEquals(132, $prefilledRetromatId);
    }

    public function testCreateNewActivityPhase1(): void
    {
        $client = $this->makeClientLoginAdmin();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->setValues(
            [
                'app_activity[phase]' => 1,
                'app_activity[name]' => 'foo',
                'app_activity[summary]' => 'bar',
                'app_activity[desc]' => 'la',
            ]
        );
        $client->submit($form);

        $this->assertStatusCode(Response::HTTP_SEE_OTHER, $client);
    }

    public function testCreateNewActivityPhase0(): void
    {
        $client = $this->makeClientLoginAdmin();
        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->setValues(
            [
                'app_activity[phase]' => 0,
                'app_activity[name]' => 'foo',
                'app_activity[summary]' => 'bar',
                'app_activity[desc]' => 'la',
            ]
        );
        $client->submit($form);

        $this->assertStatusCode(Response::HTTP_SEE_OTHER, $client);
    }

    public function testCreateNewActivityMultiple(): void
    {
        $client = $this->makeClientLoginAdmin();

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->setValues(
            [
                'app_activity[phase]' => 1,
                'app_activity[name]' => 'foo',
                'app_activity[summary]' => 'bar',
                'app_activity[desc]' => 'la',
            ]
        );
        $client->submit($form);

        $this->assertStatusCode(Response::HTTP_SEE_OTHER, $client);

        $crawler = $client->request('GET', '/en/team/activity/new');
        $form = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->setValues(
            [
                'app_activity[phase]' => 2,
                'app_activity[name]' => 'qq',
                'app_activity[summary]' => 'ww',
                'app_activity[desc]' => 'ee',
            ]
        );
        $client->submit($form);

        $this->assertStatusCode(Response::HTTP_SEE_OTHER, $client);
    }

    public function testIndexContainsOnlyTranslatedActivities(): void
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        $crawler = $client->request('GET', '/de/team/activity/');
        $this->assertCount(75 + 1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/en/team/activity/');
        $this->assertCount(131 + 1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/es/team/activity/');
        $this->assertCount(95 + 1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/fr/team/activity/');
        $this->assertCount(50 + 1, $crawler->filter('tr'));

        $crawler = $client->request('GET', '/nl/team/activity/');
        $this->assertCount(101 + 1, $crawler->filter('tr'));
    }

    public function testCreateNewActivityTranslationDeForCorrectId(): void
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        $crawler = $client->request('GET', '/de/team/activity/new');

        $this->assertEquals(75 + 1, $crawler->filter('#activity_translatable_fields_retromatId')->attr('value'));
    }

    public function testCreateNewActivityTranslationDeFormOnlyShowsTranslatableFields(): void
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        $crawler = $client->request('GET', '/de/team/activity/new');

        $formValues = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->getPhpValues();

        $translatableFields = ['name', 'summary', 'desc', '_token'];
        $this->assertEquals($translatableFields, \array_keys($formValues['activity_translatable_fields']));
    }

    public function testCreateNewActivityTranslationDe(): void
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        $crawler = $client->request('GET', '/de/team/activity/new');
        $form = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->setValues(
            [
                'activity_translatable_fields[name]' => 'foo',
                'activity_translatable_fields[summary]' => 'bar',
                'activity_translatable_fields[desc]' => 'la',
            ]
        );
        $client->submit($form);

        $this->assertStatusCode(Response::HTTP_SEE_OTHER, $client);
    }

    public function testCreateNewActivityNoPrefilledContentForEn(): void
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        $crawler = $client->request('GET', '/en/team/activity/new');

        $prefilled = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->getValues();

        $this->assertEmpty($prefilled['app_activity[name]']);
        $this->assertEmpty($prefilled['app_activity[summary]']);
        $this->assertEmpty($prefilled['app_activity[desc]']);
    }

    public function testCreateNewActivityTranslationDePrefilledFromEn(): void
    {
        $client = $this->makeClientLoginAdminLoadFixtures();

        $crawler = $client->request('GET', '/de/team/activity/new');

        $prefilled = $crawler->selectButton(self::SELECTOR_BUTTON_PRIMARY)->form()->getValues();

        $this->assertEquals('Round of Admiration', $prefilled['activity_translatable_fields[name]']);
        $this->assertEquals(
            'Participants express what they admire about one another',
            $prefilled['activity_translatable_fields[summary]']
        );
        $this->assertEquals(
            'Start a round of admiration by facing your neighbour and stating \'What I admire most about you is ...\' Then your neighbour says what she admires about her neighbour and so on until the last participants admires you. Feels great, doesn\'t it?',
            $prefilled['activity_translatable_fields[desc]']
        );
    }

    /**
     * @return Client
     */
    private function makeClientLoginAdmin(): Client
    {
        $client = $this->makeClient();
        $referenceRepository = $this->loadFixtures(
            [
                'App\Tests\Controller\DataFixtures\LoadUsers'
            ]
        )->getReferenceRepository();

        try {
            $this->loginClient($client, $referenceRepository->getReferences()[LoadUsers::USERNAME], 'main');
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        return $client;
    }

    /**
     * @return Client
     */
    private function makeClientLoginAdminLoadFixtures(): Client
    {
        $client = $this->makeClient();
        $referenceRepository = $this->loadFixtures(
            [
                'App\Tests\Controller\DataFixtures\LoadActivityData',
                'App\Tests\Controller\DataFixtures\LoadUsers',
            ]
        )->getReferenceRepository();

        try {
            $this->loginClient($client, $referenceRepository->getReferences()[LoadUsers::USERNAME], 'main');
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        return $client;
    }
}
