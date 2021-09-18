<?php

namespace App\Tests\Activity;

use App\Model\Activity\ActivityByPhase;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityByPhaseTest extends WebTestCase
{
    /**
     * @var ActivityByPhase
     */
    private $activityByPhase;

    public function setUp():void
    {
        $activityByPhase = [
            0 => [1, 2, 3, 18, 22, 31, 32, 36, 42, 43, 46, 52, 59, 70, 76, 81, 82, 84, 85, 90, 106, 107, 108, 114, 122],
            1 => [4, 5, 6, 7, 19, 33, 35, 47, 51, 54, 62, 64, 65, 75, 78, 79, 80, 86, 87, 89, 93, 97, 98, 110, 116, 119, 121, 123, 126, 127],
            2 => [8, 9, 10, 20, 25, 26, 37, 41, 50, 55, 58, 66, 68, 69, 74, 91, 94, 95, 105, 113, 115, 118],
            3 => [11, 12, 13, 21, 24, 29, 38, 39, 48, 49, 61, 63, 72, 73, 88, 96, 99, 100, 103, 117, 124, 125],
            4 => [14, 15, 16, 17, 23, 34, 40, 44, 45, 53, 57, 60, 67, 71, 77, 83, 92, 101, 102, 104, 109, 112, 120],
            5 => [27, 28, 30, 56, 111],
        ];

        $activityRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->setMethods(['findAllActivitiesByPhases'])
            ->disableOriginalConstructor()
            ->getMock();
        $activityRepository->expects($this->any())
            ->method('findAllActivitiesByPhases')
            ->will($this->returnValue($activityByPhase));

        $entityManager = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($activityRepository));

        $this->activityByPhase = new ActivityByPhase($entityManager);
    }

    public function testGetAllActivitiesByPhase()
    {
        $activityByPhase = $this->activityByPhase;

        $activitiesByPhase = $activityByPhase->getAllActivitiesByPhase();

        $this->assertEquals(3, $activitiesByPhase[0][2]);
        $this->assertEquals(18, $activitiesByPhase[0][3]);
        $this->assertEquals(4, $activitiesByPhase[1][0]);
        $this->assertEquals(8, $activitiesByPhase[2][0]);
        $this->assertEquals(11, $activitiesByPhase[3][0]);
        $this->assertEquals(21, $activitiesByPhase[3][3]);
        $this->assertEquals(14, $activitiesByPhase[4][0]);
        $this->assertEquals(27, $activitiesByPhase[5][0]);
    }

    public function testGetActivitiesString()
    {
        $activityByPhase = $this->activityByPhase;

        $this->assertEquals(
            '1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122',
            $activityByPhase->getActivitiesString(0)
        );
        $this->assertEquals('27-28-30-56-111', $activityByPhase->getActivitiesString(5));
    }

    public function testNextActivityIdInPhase()
    {
        $activityByPhase = $this->activityByPhase;

        $this->assertEquals('31', $activityByPhase->nextActivityIdInPhase(0, 22));
        $this->assertEquals('24', $activityByPhase->nextActivityIdInPhase(3, 21));
        $this->assertEquals('1', $activityByPhase->nextActivityIdInPhase(0, 122));
    }

    public function testPreviousActivityIdInPhase()
    {
        $activityByPhase = $this->activityByPhase;

        $this->assertEquals('18', $activityByPhase->previousActivityIdInPhase(0, 22));
        $this->assertEquals('13', $activityByPhase->previousActivityIdInPhase(3, 21));
        $this->assertEquals('122', $activityByPhase->previousActivityIdInPhase(0, 1));
    }

    public function testNextIds()
    {
        $activityByPhase = $this->activityByPhase;

        $this->assertEquals([18], $activityByPhase->nextIds([3], 3, 0));
        $this->assertEquals([18, 87, 113, 13, 16], $activityByPhase->nextIds([3, 87, 113, 13, 16], 3, 0));
        $this->assertEquals([1, 87, 113, 13, 16], $activityByPhase->nextIds([122, 87, 113, 13, 16], 122, 0));
        $this->assertEquals([3, 89, 113, 13, 16], $activityByPhase->nextIds([3, 87, 113, 13, 16], 87, 1));
    }

    public function testPreviousIds()
    {
        $activityByPhase = $this->activityByPhase;

        $this->assertEquals([3], $activityByPhase->previousIds([18], 18, 0));
        $this->assertEquals([122], $activityByPhase->previousIds([1], 1, 0));
    }

    public function testActiviyIdsUnique()
    {
        $activityByPhase = $this->activityByPhase;

        $activities = [];
        foreach ($activityByPhase->getAllActivitiesByPhase() as $activitiesInPhase) {
            $activities = array_merge($activities, $activitiesInPhase);
        }

        $this->assertEquals(array_unique($activities), $activities);
    }
}
