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
}
