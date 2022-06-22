<?php

namespace App\Tests\Importer\Activity;

use App\Model\Importer\Activity\ActivityImporter;
use App\Model\Importer\Activity\ActivityReader;
use App\Model\Importer\Activity\Exception\InvalidActivityException;
use App\Model\Importer\Activity\Hydrator\ActivityHydrator;
use App\Tests\AbstractTestCase;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ActivityImporterIntegrationTest extends AbstractTestCase
{
    public function testImportOnEmptyDbEn()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(null, ['en' => __DIR__.'/TestData/activities_en.js']);

        $activityHydrator = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $activityHydrator, $validator);

        $activityImporter->import();
        $entityManager->clear();

        $this->assertCount(129, $entityManager->getRepository('App:Activity')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 123])->translate(
                'en'
            )->getSummary()
        );
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportOnTopOfExisting()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(null, ['en' => __DIR__.'/TestData/activities_en.js']);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import();
        $entityManager->clear();

        $activity2 = $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 123]);
        $entityManager->remove($activity2);
        $entityManager->flush();
        $this->assertCount(128, $entityManager->getRepository('App:Activity')->findAll());

        $activityImporter->import();
        $entityManager->clear();

        $this->assertCount(129, $entityManager->getRepository('App:Activity')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportOnEmptyDbDe()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(
            null,
            [
                'en' => __DIR__.'/TestData/activities_en.js',
                'de' => __DIR__.'/TestData/activities_de.js',
            ]
        );
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator, ['de']);

        $activityImporter->import();
        $entityManager->clear();

        // 129, because English is always imported to set the metadate correctly
        $this->assertCount(129, $entityManager->getRepository('App:Activity')->findAll());
        $activity2 = $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 71]);
        $this->assertEquals(
            'Kläre, wie zufrieden das Team ist mit Retro-Ergebnisse der Retrospektive, einer fairen Verteilung der Redezeit und der Stimmung während der Retrospektive war',
            $activity2->translate('de', $fallbackToDefault = false)->getSummary()
        );
        $activity2->setCurrentLocale('de');
        $this->assertEquals(
            'Kläre, wie zufrieden das Team ist mit Retro-Ergebnisse der Retrospektive, einer fairen Verteilung der Redezeit und der Stimmung während der Retrospektive war',
            $activity2->getSummary()
        );
    }

    public function testImportOnEmptyDbEnDe()
    {
        $this->loadFixtures([]);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityFileNames = [
            'en' => __DIR__.'/TestData/activities_en.js',
            'de' => __DIR__.'/TestData/activities_de.js',
        ];
        $reader = new ActivityReader(null, $activityFileNames);
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator, ['en', 'de']);

        $activityImporter->import();
        $entityManager->clear();

        $this->assertCount(129, $entityManager->getRepository('App:Activity')->findAll());

        $activity2 = $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 71]);
        $this->assertEquals(
            'Check satisfaction with retro results, fair distribution of talk time &amp; mood',
            $activity2->translate('en')->getSummary()
        );
        $this->assertEquals(
            'Kläre, wie zufrieden das Team ist mit Retro-Ergebnisse der Retrospektive, einer fairen Verteilung der Redezeit und der Stimmung während der Retrospektive war',
            $activity2->translate('de', $fallbackToDefault = false)->getSummary()
        );

        $activity2->setCurrentLocale('en');
        $this->assertEquals(
            'Check satisfaction with retro results, fair distribution of talk time &amp; mood',
            $activity2->getSummary()
        );
        $activity2->setCurrentLocale('de');
        $this->assertEquals(
            'Kläre, wie zufrieden das Team ist mit Retro-Ergebnisse der Retrospektive, einer fairen Verteilung der Redezeit und der Stimmung während der Retrospektive war',
            $activity2->getSummary()
        );
    }

    public function testImportThrowsExceptionOnInvalidActivity()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(null, ['en' => __DIR__.'/TestData/activities_en_1_valid_1_invalid.js']);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        try {
            $activityImporter->import();
        } catch (InvalidActivityException $exception) {
            $this->assertTrue(true);

            return;
        }

        $this->fail('Expected exception not thrown: InvalidActivityException for Activity (type 1).');
    }

    public function testImportThrowsExceptionOnInvalidActivityMeta()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(null, ['en' => __DIR__.'/TestData/activities_en_1_valid_1_invalid.js']);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        try {
            $activityImporter->import2();
        } catch (InvalidActivityException $exception) {
            $this->assertTrue(true);

            return;
        }

        $this->fail('Expected exception not thrown: InvalidActivityException for Activity metadata.');
    }

    public function testImportThrowsExceptionOnInvalidActivityTranslation()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(
            null,
            ['en' => __DIR__.'/TestData/activities_en_1_valid_1_invalid_translation.js']
        );

        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        try {
            $activityImporter->import2();
        } catch (InvalidActivityException $exception) {
            $this->assertTrue(true);

            return;
        }

        $this->fail('Expected exception not thrown: InvalidActivityException for Activity translation.');
    }

    public function testImportUpdatesExisting()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(null, ['en' => __DIR__.'/TestData/activities_en_esvp.js']);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import();
        $entityManager->clear();

        $this->assertEquals(
            'ESVP',
            $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 1])->getName()
        );

        $reader2 = new ActivityReader(null, ['en' => __DIR__.'/TestData/activities_en_esvp_updated.js']);
        $activityImporter2 = new ActivityImporter($entityManager, $reader2, $mapper, $validator);

        $activityImporter2->import();
        $entityManager->clear();

        $this->assertEquals(
            'ESVPupdated',
            $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 1])->getName()
        );
    }

    public function testImport2MultipleImportsAllLanguages()
    {
        $this->loadFixtures([]);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityFileNames = [
            'en' => __DIR__.'/TestData/activities_en.js',
            'de' => __DIR__.'/TestData/activities_de.js',
        ];
        $reader = new ActivityReader(null, $activityFileNames);
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import2Multiple(['en', 'de']);
        $entityManager->clear();

        $this->assertCount(129, $entityManager->getRepository('App:Activity')->findAll());

        $activity2 = $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 71]);
        $this->assertEquals(
            'Check satisfaction with retro results, fair distribution of talk time &amp; mood',
            $activity2->translate('en')->getSummary()
        );
        $this->assertEquals(
            'Kläre, wie zufrieden das Team ist mit Retro-Ergebnisse der Retrospektive, einer fairen Verteilung der Redezeit und der Stimmung während der Retrospektive war',
            $activity2->translate('de', $fallbackToDefault = false)->getSummary()
        );

        $activity2->setCurrentLocale('en');
        $this->assertEquals(
            'Check satisfaction with retro results, fair distribution of talk time &amp; mood',
            $activity2->getSummary()
        );
        $activity2->setCurrentLocale('de');
        $this->assertEquals(
            'Kläre, wie zufrieden das Team ist mit Retro-Ergebnisse der Retrospektive, einer fairen Verteilung der Redezeit und der Stimmung während der Retrospektive war',
            $activity2->getSummary()
        );
    }

    public function testImport2MultipleMetaDataFromEnglishOnly()
    {
        $this->loadFixtures([]);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityFileNames = [
            'en' => __DIR__.'/TestData/activities_en_esvp.js',
            'de' => __DIR__.'/TestData/activities_de_feug_wrong_translated_meta.js',
        ];
        $reader = new ActivityReader(null, $activityFileNames);
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import2Multiple(['en', 'de']);
        $entityManager->clear();

        $this->assertCount(1, $entityManager->getRepository('App:Activity')->findAll());

        $activity2 = $entityManager->getRepository('App:Activity')->findOneBy(['retromatId' => 1]);
        $this->assertEquals(
            'Short',
            $activity2->getDuration()
        );
    }

    public function testImport2MultipleNoSuperfluousNonEnglishTransations()
    {
        $this->loadFixtures([]);
        $mapper = new ActivityHydrator();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityFileNames = [
            'en' => __DIR__.'/TestData/activities_en_2.js',
            'de' => __DIR__.'/TestData/activities_de_feug_wrong_translated_meta.js',
        ];
        $reader = new ActivityReader(null, $activityFileNames);
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import2Multiple(['en', 'de']);
        $entityManager->clear();

        $this->assertCount(2, $entityManager->getRepository('App:Activity')->findAll());
        $this->assertCount(3, $entityManager->getRepository('App:ActivityTranslation')->findAll());
    }
}
