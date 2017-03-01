<?php

namespace AppBundle\Plan;

class PlanIdGenerator
{
    /**
     * @param callable $callback
     * @param array $activitiesByPhase
     */
    public function generateAll(callable $callback, array $activitiesByPhase)
    {
        foreach ($activitiesByPhase[4] as $id4) {
            foreach ($activitiesByPhase[3] as $id3) {
                foreach ($activitiesByPhase[2] as $id2) {
                    foreach ($activitiesByPhase[1] as $id1) {
                        foreach ($activitiesByPhase[0] as $id0) {
                            call_user_func($callback, $id0.'-'.$id1.'-'.$id2.'-'.$id3.'-'.$id4);
                        }
                    }
                }
            }
        }
    }
}