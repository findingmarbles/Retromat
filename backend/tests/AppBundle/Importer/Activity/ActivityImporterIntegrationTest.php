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
        $activityImporter = new ActivityImporter($this->getMock(ObjectManager::class), $reader, $mapper, $filter, $validator);

        $activity = $activityImporter->getAllValidActivities();

        $this->assertEquals('ESVP', $activity[0]->getName());
        $this->assertNull($activity[0]->getMore());
        $this->assertEquals('Discuss the 12 agile principles and pick one to work on', $activity[122]->getSummary());
    }

    public function testImport()
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

        $activityImporter->import();

        $this->assertEquals(
            'Discuss the 12 agile principles and pick one to work on',
            $entityManager->getRepository('AppBundle:Activity')->findOneBy(['retromatId' => 123])->getSummary()
        );
    }

    public function testImportSkipInvalid()
    {
        $this->loadFixtures([]);
        // $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en_only_1_valid.js');
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

        $this->assertCount(
            1,
            $entityManager->getRepository('AppBundle:Activity')->findAll(),
            'When skipping invalid acitivities, there should only be a single valid activity in this import.'
        );

    }
}
