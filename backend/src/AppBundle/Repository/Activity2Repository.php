<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;

class Activity2Repository extends EntityRepository
{
    /**
     * @param array $orderedIds
     * @return array
     *
     * Caching millions of combinations of e.g. 5 activities separately would not make sense, but
     * findAllOrdered already caches all activities. Reuse this cache for speed.
     */
    public function findOrdered(array $orderedIds): array
    {
        $allActivities = $this->findAllOrdered();
        $orderedActivities = [];
        foreach ($orderedIds as $id) {
            $orderedActivities[] = $allActivities[$id-1];
        }

        return $orderedActivities;
    }

    /**
     * @return array
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'a2t')
            ->leftJoin('a.translations', 'a2t', Join::WITH, 'a2t.translatable = a.id')
            ->orderBy('a.retromatId', 'ASC')
            ->getQuery()
            ->useResultCache(true, 86400)
            ->getResult();
    }

    /**
     * @return array
     */
    public function findAllActivitiesByPhases(): array
    {
        $activitiesByPhase = [];

        $activities = $this->createQueryBuilder('a')
            ->select('a.retromatId', 'a.phase')
            ->getQuery()
            ->useResultCache(true, 86400)
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($activities as $activity) {
            $activitiesByPhase[$activity['phase']][] = $activity['retromatId'];
        }

        return $activitiesByPhase;
    }
}
