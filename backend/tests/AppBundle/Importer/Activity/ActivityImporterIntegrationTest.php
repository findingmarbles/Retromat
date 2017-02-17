<?php

namespace tests\AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\ActivityImporter;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Importer\Activity\ActivityReader;
use AppBundle\Importer\ArrayToObjectMapper;
use AppBundle\Importer\EntityCollectionFilter;
use AppBundle\Importer\StringLogger;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ActivityImporterIntegrationTest extends WebTestCase
{
    public function testGetAllValidActivities()
    {
        $reader = new ActivityReader($activityFileName = __DIR__.'/TestData/activities_en.js');

        $mapper = new ArrayToObjectMapper();

        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');
        $logger = new StringLogger();
        $filter = new EntityCollectionFilter($validator, $logger);

        $activityImporter = new ActivityImporter($reader, $mapper, $filter);
        $activity = $activityImporter->getAllValidActivities();
        $this->assertEquals('ESVP', $activity[0]->getName());
        $this->assertNull($activity[0]->getMore());
        $this->assertEquals('Discuss the 12 agile principles and pick one to work on', $activity[122]->getSummary());
    }
}
