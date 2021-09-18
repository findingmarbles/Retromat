<?php
declare(strict_types = 1);

namespace App\Tests\Repository;

use App\Tests\AbstractTestCase;

class ActivityRepositoryTest extends AbstractTestCase
{
    public function testFindOrdered()
    {
        $this->loadFixtures(['App\Tests\Repository\DataFixtures\LoadActivityData']);

        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('App:Activity');
        $ordered = $repo->findOrdered($id = [3, 87, 113, 13, 16]);

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
        $this->loadFixtures(['App\Tests\Repository\DataFixtures\LoadActivityData']);

        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('App:Activity');
        $ordered = $repo->findAllOrdered();

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
        $this->loadFixtures(
            ['App\Tests\Repository\DataFixtures\LoadActivityDataForTestFindAllActivitiesForPhases']
        );
        $activityRepository = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository(
            'App:Activity'
        );

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

    public function testFindAllActivitiesForPhasesDe()
    {
        $this->loadFixtures(
            ['App\Tests\Repository\DataFixtures\LoadActivityDataForTestFindAllActivitiesForPhasesDe']
        );
        $activityRepository = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository(
            'App:Activity'
        );

        $expectedActivityByPhase = [
            0 => [1, 7],
            1 => [2, 8],
            2 => [3, 9],
            3 => [4, 10],
            4 => [5],
            5 => [6],
        ];

        $this->assertEquals($expectedActivityByPhase, $activityRepository->findAllActivitiesByPhases('de'));
    }
}
