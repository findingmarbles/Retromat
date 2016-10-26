<?php

namespace tests\AppBundle\Twig;

use AppBundle\Twig\ActivityByPhase;

class ActivityByPhaseTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAllActivitiesByPhase()
    {
        $activityByPhase = new ActivityByPhase;
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
        $activityByPhase = new ActivityByPhase;

        $this->assertEquals('1-2-3-18-22-31-32-36-42-43-46-52-59-70-76-81-82-84-85-90-106-107-108-114-122', $activityByPhase->getActivitiesString(0));
        $this->assertEquals('27-28-30-56-111', $activityByPhase->getActivitiesString(5));
    }

    public function testNextActivityIdInPhase()
    {
        $activityByPhase = new ActivityByPhase;

        $this->assertEquals('31', $activityByPhase->nextActivityIdInPhase(0, 22));
        $this->assertEquals('24', $activityByPhase->nextActivityIdInPhase(3, 21));
    }
}
