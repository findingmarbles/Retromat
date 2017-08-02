<?php
declare(strict_types=1);

namespace tests\AppBundle\Repository;

// tests directory is not available to the autoloader, so we have to manually require these files:
require 'DataFixtures/LoadActivityData.php';
require 'DataFixtures/LoadActivityDataForTestFindAllActivitiesForPhases.php';

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityRepositoryTest extends WebTestCase
{
    public function testFindOrdered()
    {
        $this->loadFixtures(['tests\AppBundle\Repository\DataFixtures\LoadActivityData']);

        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        $ordered = $repo->findOrdered($language = 'en', $id = [3, 87, 113, 13, 16]);

        // check for correct keys
        $this->assertEquals(3, $ordered[0]->getRetromatId());
        $this->assertEquals(87, $ordered[1]->getRetromatId());
        $this->assertEquals(113, $ordered[2]->getRetromatId());
        $this->assertEquals(13, $ordered[3]->getRetromatId());
        $this->assertEquals(16, $ordered[4]->getRetromatId());

        // check for correct order of keys
        $this->assertEquals(3, reset($ordered)->getRetromatId());
        $this->assertEquals(87, next($ordered)->getRetromatId());
        $this->assertEquals(113, next($ordered)->getRetromatId());
        $this->assertEquals(13, next($ordered)->getRetromatId());
        $this->assertEquals(16, end($ordered)->getRetromatId());
    }

    public function testFindAllOrdered()
    {
        $this->loadFixtures(['tests\AppBundle\Repository\DataFixtures\LoadActivityData']);

        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        $ordered = $repo->findAllOrdered($language = 'en');

        // check for correct keys
        $this->assertEquals(1, $ordered[0]->getRetromatId());
        $this->assertEquals(2, $ordered[1]->getRetromatId());
        $this->assertEquals(3, $ordered[2]->getRetromatId());

        // check for correct order of keys
        $this->assertEquals(1, reset($ordered)->getRetromatId());
        $this->assertEquals(2, next($ordered)->getRetromatId());
        $this->assertEquals(3, next($ordered)->getRetromatId());
    }

    public function testFindAllActivitiesForPhases()
    {
        $this->loadFixtures(['tests\AppBundle\Repository\DataFixtures\LoadActivityDataForTestFindAllActivitiesForPhases']);
        $activityRepository = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');

        $expectedActivityByPhase = [
            0 => [1, 7],
            1 => [2, 8],
            2 => [3, 9],
            3 => [4, 10],
            4 => [5, 11],
            5 => [6, 12],
        ];

        $this->assertEquals($expectedActivityByPhase, $activityRepository->findAllActivitiesByPhases());
    }
}
