<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use AppBundle\Entity\Activity;

class ActivityRepository extends EntityRepository
{
    /**
     * @param string $language
     * @param array $orderedIds
     * @return array
     *
     * Caching millions of combinations of e.g. 5 activities separately would not make sense, but
     * findAllOrdered already caches all activities. Reuse this cache for speed.
     */
    public function findOrdered(string $language, array $orderedIds): array
    {
        $allActivities = $this->findAllOrdered($language);
        $orderedActivities = [];
        foreach ($orderedIds as $id) {
            $orderedActivities[] = $allActivities[$id-1];
        }

        return $orderedActivities;
    }

    /**
     * @param string $language
     * @return array
     */
    public function findAllOrdered(string $language): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.retromatId', 'ASC')
            ->getQuery()
            ->useResultCache(true, 86400, 'retromat_findAllOrdered')
            ->getResult();
    }

    /**
     * @return array
     */
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
