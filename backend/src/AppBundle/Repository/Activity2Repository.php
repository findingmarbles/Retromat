<?php
declare(strict_types = 1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\Activity2;

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
            if (array_key_exists($id - 1, $allActivities)) {
                $orderedActivities[] = $allActivities[$id - 1];
            }
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
     * @param string $locale
     * @return array
     */
    public function findAllActivitiesByPhases(string $locale = 'en'): array
    {
        $activitiesByPhase = [];

        $activities = $this->findAllOrdered();
        /** @var $activity Activity2 */
        foreach ($activities as $activity) {
            if (!empty($activity->translate($locale, false)->getId())) {
                $activitiesByPhase[$activity->getPhase()][] = $activity->getRetromatId();
            } else {
                break;
            }
        }

        return $activitiesByPhase;
    }
}
