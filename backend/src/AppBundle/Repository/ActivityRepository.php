<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use AppBundle\Entity\Activity;

class ActivityRepository extends EntityRepository
{
    public function findOrdered(string $language, array $orderedIds): array
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

    public function findAllOrdered(string $language): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.retromatId', 'ASC')
            ->getQuery()
            ->useResultCache(true, 86400, 'retromat_findAllOrdered')
            ->getResult();
    }

    public function findAllActivitiesByPhases(): array
    {
        $activitiesByPhase = [];

        $activities = $this->createQueryBuilder('a')
            ->select('a.retromatId, a.phase')
            ->getQuery()
            ->useResultCache(true, 86400, 'retromat_findAllActivitiesByPhases')
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($activities as $activity) {
            $activitiesByPhase[$activity['phase']][] = $activity['retromatId'];
        }

        return $activitiesByPhase;
    }
}
