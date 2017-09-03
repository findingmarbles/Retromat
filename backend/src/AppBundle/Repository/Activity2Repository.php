<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class Activity2Repository extends EntityRepository
{
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
            ->useResultCache(true, 86400, 'retromat_Activity2Repository_findAllOrdered')
            ->getResult();
    }
}
