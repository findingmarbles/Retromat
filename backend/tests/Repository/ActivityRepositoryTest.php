<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Repository\ActivityRepository;
use App\Tests\AbstractTestCase;

class ActivityRepositoryTest extends AbstractTestCase
{
    private ActivityRepository $activityRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures([]);
        $this->activityRepository = $this->getContainer()->get(ActivityRepository::class);
    }

    public function testFindOrdered(): void
    {
        $this->loadFixtures(['App\Tests\Repository\DataFixtures\LoadActivityData']);

        $ordered = $this->activityRepository->findOrdered([3, 87, 113, 13, 16]);

        // check for correct keys
        $this->assertEquals(3, $ordered[0]->getRetromatId());
        $this->assertEquals(87, $ordered[1]->getRetromatId());
        $this->assertEquals(113, $ordered[2]->getRetromatId());
        $this->assertEquals(13, $ordered[3]->getRetromatId());
        $this->assertEquals(16, $ordered[4]->getRetromatId());

        // check for correct order of keys
        $this->assertEquals(3, \reset($ordered)->getRetromatId());
        $this->assertEquals(87, \next($ordered)->getRetromatId());
        $this->assertEquals(113, \next($ordered)->getRetromatId());
        $this->assertEquals(13, \next($ordered)->getRetromatId());
        $this->assertEquals(16, \end($ordered)->getRetromatId());
    }

    public function testFindAllOrdered(): void
    {
        $this->loadFixtures(['App\Tests\Repository\DataFixtures\LoadActivityData']);

        $ordered = $this->activityRepository->findAllOrdered();

        // check for correct keys
        $this->assertEquals(1, $ordered[0]->getRetromatId());
        $this->assertEquals(2, $ordered[1]->getRetromatId());
        $this->assertEquals(3, $ordered[2]->getRetromatId());

        // check for correct order of keys
        $this->assertEquals(1, \reset($ordered)->getRetromatId());
        $this->assertEquals(2, \next($ordered)->getRetromatId());
        $this->assertEquals(3, \next($ordered)->getRetromatId());
    }

    /**
     * @return void
     */
    public function testFindAllActivitiesForPhases(): void
    {
        $this->loadFixtures(
            ['App\Tests\Repository\DataFixtures\LoadActivityDataForTestFindAllActivitiesForPhases']
        );

        // WTF? When running in Docker, this fails, but when sleeping 1 s it succeeds.
        sleep(1);

        $expectedActivityByPhase = [
            0 => [1, 7],
            1 => [2, 8],
            2 => [3, 9],
            3 => [4, 10],
            4 => [5, 11],
            5 => [6, 12],
        ];

        $this->assertEquals($expectedActivityByPhase, $this->activityRepository->findAllActivitiesByPhases());
    }

    public function testFindAllActivitiesForPhasesDe(): void
    {
        $this->loadFixtures(
            ['App\Tests\Repository\DataFixtures\LoadActivityDataForTestFindAllActivitiesForPhasesDe']
        );

        // WTF? When running in Docker, this fails, but when sleeping 1 s it succeeds.
        sleep(1);

        $expectedActivityByPhase = [
            0 => [1, 7],
            1 => [2, 8],
            2 => [3, 9],
            3 => [4, 10],
            4 => [5],
            5 => [6],
        ];

        $this->assertEquals($expectedActivityByPhase, $this->activityRepository->findAllActivitiesByPhases('de'));
    }
}
