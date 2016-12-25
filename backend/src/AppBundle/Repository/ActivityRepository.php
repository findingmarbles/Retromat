<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use AppBundle\Entity\Activity;

class ActivityRepository extends EntityRepository
{
    public function findOrdered($language, array $orderedIds)
    {
        $unOrderedActivities = $this->findBy(['language' => $language, 'retromatId' => $orderedIds]);
        $orderedActivities = [];

        // assign keys indicating correct position
        foreach ($unOrderedActivities as $activity) {
            /** @var Activity $activity */
            $orderedActivities[array_search($activity->getRetromatId(), $orderedIds)] = $activity;
        }

        // order associative array by keys
        ksort($orderedActivities);

        return $orderedActivities;
    }

    public function findAllActivitiesByPhases()
    {
        $activitiesByPhase = [];

        $activities = $this->createQueryBuilder('a')
            ->select('a.retromatId, a.phase')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($activities as $activity) {
            $activitiesByPhase[$activity['phase']][] = $activity['retromatId'];
        }

        return $activitiesByPhase;
    }
}
