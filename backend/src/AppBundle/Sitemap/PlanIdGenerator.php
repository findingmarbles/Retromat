<?php
declare(strict_types = 1);

namespace AppBundle\Sitemap;

use AppBundle\Activity\ActivityByPhase;

class PlanIdGenerator
{
    /**
     * @var ActivityByPhase $activityByPhase
     */
    private $activityByPhase;

    /**
     * @param ActivityByPhase $activityByPhase
     */
    public function __construct(ActivityByPhase $activityByPhase)
    {
        $this->activityByPhase = $activityByPhase;
    }

    /**
     * @param callable $callback
     * @param int $maxResults
     * @param int $skip
     */
    public function generate(callable $callback, int $maxResults = PHP_INT_MAX, int $skip = 0)
    {
        $activitiesByPhase = $this->activityByPhase->getAllActivitiesByPhase();
        $totalResults = 0;
        foreach ($activitiesByPhase[4] as $id4) {
            foreach ($activitiesByPhase[3] as $id3) {
                foreach ($activitiesByPhase[2] as $id2) {
                    foreach ($activitiesByPhase[1] as $id1) {
                        foreach ($activitiesByPhase[0] as $id0) {
                            if ($totalResults >= $maxResults) {
                                return;
                            } elseif (0 < $skip) {
                                --$skip;
                            } else {
                                ++$totalResults;
                                call_user_func($callback, $id0.'-'.$id1.'-'.$id2.'-'.$id3.'-'.$id4);
                            }
                        }
                    }
                }
            }
        }
    }
}