<?php
declare(strict_types = 1);

namespace AppBundle\Plan;

use AppBundle\Activity\ActivityByPhase;

class PlanIdGenerator
{
    /**
     * @var array $activitiesByPhase
     */
    private $activitiesByPhase;

    /**
     * @param ActivityByPhase $activityByPhase
     */
    public function __construct(ActivityByPhase $activityByPhase)
    {
        $this->activitiesByPhase = $activityByPhase->getAllActivitiesByPhase();
    }

    /**
     * @param callable $callback
     */
    public function generateAll(callable $callback)
    {
        foreach ($this->activitiesByPhase[4] as $id4) {
            foreach ($this->activitiesByPhase[3] as $id3) {
                foreach ($this->activitiesByPhase[2] as $id2) {
                    foreach ($this->activitiesByPhase[1] as $id1) {
                        foreach ($this->activitiesByPhase[0] as $id0) {
                            call_user_func($callback, $id0.'-'.$id1.'-'.$id2.'-'.$id3.'-'.$id4);
                        }
                    }
                }
            }
        }
    }
}