<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    /**
     * @param array $orderedIds
     * @return array
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
