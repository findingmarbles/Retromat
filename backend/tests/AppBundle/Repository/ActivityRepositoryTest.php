<?php

namespace tests\AppBundle\Repository;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityRepositoryTest extends WebTestCase
{
    public function testFindOrdered()
    {
        $this->loadFixtures(['AppBundle\DataFixtures\ORM\LoadActivityData']);
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

    public function testFindAllActivitiesForPhases()
    {
        // @Todo: Needs separate fixture to allow adding activities without test code changes
        $this->loadFixtures(['AppBundle\DataFixtures\ORM\LoadActivityData']);
        $activityRepository = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');

        $expectedActivityByPhase = [
            0 => [1, 2, 3, 18, 22, 31, 32, 36, 42, 43, 46, 52, 59, 70, 76, 81, 82, 84, 85, 90, 106, 107, 108, 114, 122],
            1 => [4, 5, 6, 7, 19, 33, 35, 47, 51, 54, 62, 64, 65, 75, 78, 79, 80, 86, 87, 89, 93, 97, 98, 110, 116, 119, 121, 123, 126, 127],
            2 => [8, 9, 10, 20, 25, 26, 37, 41, 50, 55, 58, 66, 68, 69, 74, 91, 94, 95, 105, 113, 115, 118],
            3 => [11, 12, 13, 21, 24, 29, 38, 39, 48, 49, 61, 63, 72, 73, 88, 96, 99, 100, 103, 117, 124, 125],
            4 => [14, 15, 16, 17, 23, 34, 40, 44, 45, 53, 57, 60, 67, 71, 77, 83, 92, 101, 102, 104, 109, 112, 120],
            5 => [27, 28, 30, 56, 111],
        ];

        $this->assertEquals($expectedActivityByPhase, $activityRepository->findAllActivitiesByPhases());
    }
}
