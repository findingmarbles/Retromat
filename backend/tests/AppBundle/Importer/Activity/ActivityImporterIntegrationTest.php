<?php

namespace tests\AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\ActivityImporter;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Importer\Activity\ActivityReader;
use AppBundle\Importer\ArrayToObjectMapper;
use AppBundle\Importer\EntityCollectionFilter;
use AppBundle\Importer\StringLogger;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityImporterIntegrationTest extends WebTestCase
{
    public function testGetAllValidActivities()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        $logger = new StringLogger();
        $filter = new EntityCollectionFilter($validator, $logger);
        $activityImporter = new ActivityImporter(
            $this->getMock(ObjectManager::class),
            $reader,
            $mapper,
            $filter,
            $validator
        );

        $activity = $activityImporter->getAllValidActivities();

        $this->assertEquals('ESVP', $activity[0]->getName());
        $this->assertNull($activity[0]->getMore());
        $this->assertEquals('Discuss the 12 agile principles and pick one to work on', $activity[122]->getSummary());
    }

    public function testImportOnEmptyDb()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        $logger = new StringLogger();
        $filter = new EntityCollectionFilter($validator, $logger);
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $filter, $validator);

        $activityImporter->import();

        $this->assertCount(129, $entityManager->getRepository('AppBundle:Activity')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportOnTopOfExisting()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        $logger = new StringLogger();
        $filter = new EntityCollectionFilter($validator, $logger);
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $filter, $validator);

        $activityImporter->import();
        $activity = $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123]);
        $entityManager->remove($activity);
        $entityManager->flush();

        $this->assertCount(128, $entityManager->getRepository('AppBundle:Activity')->findAll());

        $activityImporter->import();

        $this->assertCount(129, $entityManager->getRepository('AppBundle:Activity')->findAll());
        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportSkipInvalid()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader(__DIR__.'/TestData/activities_en_1_valid_1_invalid.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        $logger = new StringLogger();
        $filter = new EntityCollectionFilter($validator, $logger);
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $filter, $validator);

        $activityImporter->import();

        $this->assertCount(
            1,
            $entityManager->getRepository('AppBundle:Activity')->findAll(),
            'When skipping invalid acitivities, there should only be a single valid activity in this import.'
        );
    }

    public function testImportUpdatesExisting()
    {
        $this->loadFixtures([]);
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en_1_valid_1_invalid.js');
        $mapper = new ArrayToObjectMapper();
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        $logger = new StringLogger();
        $filter = new EntityCollectionFilter($validator, $logger);
        /** @var ObjectManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $activityImporter = new ActivityImporter($entityManager, $reader, $mapper, $filter, $validator);

        $activityImporter->import();

        $this->assertEquals(
            'ESVP',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 1])->getName()
        );

        $reader2 = new ActivityReader(__DIR__.'/TestData/activities_en_1_valid_1_invalid_updated_1.js');
        $activityImporter2 = new ActivityImporter($entityManager, $reader2, $mapper, $filter, $validator);

        $activityImporter2->import();

        $this->assertEquals(
            'ESVPupdated',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 1])->getName()
        );
    }
}
