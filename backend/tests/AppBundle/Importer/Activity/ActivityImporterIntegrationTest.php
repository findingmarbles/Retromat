<?php

namespace tests\AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\ActivityImporter;
use AppBundle\Importer\Activity\Exception\InvalidActivityException;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Importer\Activity\ActivityReader;
use AppBundle\Importer\ArrayToObjectMapper;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityImporterIntegrationTest extends WebTestCase
{
    public function testImportOnEmptyDb()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import();

        // structure we are migrating away from
        $this->assertCount(129, $entityManager->getRepository('AppBundle:Activity')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );

        // structure we are migrating to
        $this->assertCount(129, $entityManager->getRepository('AppBundle:Activity2')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => 123])->translate('en')->getSummary()
        );
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportOnTopOfExisting()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import();

        // structure we are migrating away from
        $activity = $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123]);
        $entityManager->remove($activity);
        $entityManager->flush();
        $this->assertCount(128, $entityManager->getRepository('AppBundle:Activity')->findAll());

        // structure we are migrating to
        $activity2 = $entityManager->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => 123]);
        $entityManager->remove($activity2);
        $entityManager->flush();
        $this->assertCount(128, $entityManager->getRepository('AppBundle:Activity2')->findAll());

        $activityImporter->import();

        // structure we are migrating away from
        $this->assertCount(129, $entityManager->getRepository('AppBundle:Activity')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );

        // structure we are migrating to
        $this->assertCount(129, $entityManager->getRepository('AppBundle:Activity2')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportThrowsExceptionOnInvalidActivity()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(__DIR__.'/TestData/activities_en_1_valid_1_invalid.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        try {
            $activityImporter->import1();
        } catch (InvalidActivityException $exception) {
            return;
        }

        $this->fail('Expected exception not thrown: InvalidActivityException for Activity (type 1).');
    }

    public function testImportThrowsExceptionOnInvalidActivity2Meta()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(__DIR__.'/TestData/activities_en_1_valid_1_invalid_meta.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        try {
            $activityImporter->import2();
        } catch (InvalidActivityException $exception) {
            return;
        }

        $this->fail('Expected exception not thrown: InvalidActivityException for Activity2 metadata.');
    }


    public function testImportThrowsExceptionOnInvalidActivity2Translation()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(__DIR__.'/TestData/activities_en_1_valid_1_invalid_translation.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        try {
            $activityImporter->import2();
        } catch (InvalidActivityException $exception) {
            return;
        }

        $this->fail('Expected exception not thrown: InvalidActivityException for Activity2 translation.');
    }

    public function testImportUpdatesExisting()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en_esvp.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $validator);

        $activityImporter->import();

        // structure we are migrating away from
        $this->assertEquals(
            'ESVP',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 1])->getName()
        );

        // structure we are migrating to
        $this->assertEquals(
            'ESVP',
            $entityManager->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => 1])->getName()
        );

        $reader2 = new ActivityReader(__DIR__.'/TestData/activities_en_esvp_updated.js');
        $activityImporter2 = new ActivityImporter($entityManager, $reader2, $mapper, $validator);

        $activityImporter2->import();

        // structure we are migrating away from
        $this->assertEquals(
            'ESVPupdated',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 1])->getName()
        );

        // structure we are migrating to
        $this->assertEquals(
            'ESVPupdated',
            $entityManager->getRepository('AppBundle:Activity2')->findOneBy(['retromatId' => 1])->getName()
        );
    }
}
