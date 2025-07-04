<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

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

    public function findOrdered(array $orderedIds): array
    {
        // load all from RAM via results cache in Redis
        // to avoid populating the results cache with individual results
        // for billions of combinations
        $allActivities = $this->findAllOrdered();
        $orderedActivities = [];
        foreach ($orderedIds as $id) {
            if (\array_key_exists($id - 1, $allActivities)) {
                $orderedActivities[] = $allActivities[$id - 1];
            }
        }

        return $orderedActivities;
    }

    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'a2t')
            ->leftJoin('a.translations', 'a2t', Join::WITH, 'a2t.translatable = a.id')
            ->orderBy('a.retromatId', 'ASC')
            ->getQuery()
            ->enableResultCache(true, 86400)
            ->getResult();
    }

    public function findAllActivitiesByPhases(string $locale = 'en'): array
    {
        $activitiesByPhase = [];
        $activities = $this->findAllOrdered();

        foreach ($activities as $activity) {
            /** @var $activity Activity */
            if (!$activity->translate($locale, false)->isEmpty()) {
                $activitiesByPhase[$activity->getPhase()][] = $activity->getRetromatId();
            } else {
                break;
            }
        }

        return $activitiesByPhase;
    }
}
