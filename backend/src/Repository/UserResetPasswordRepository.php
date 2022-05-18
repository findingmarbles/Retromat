<?php

namespace App\Repository;

use App\Entity\UserResetPasswordRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<UserResetPasswordRequest>
 *
 * @method UserResetPasswordRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserResetPasswordRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserResetPasswordRequest[]    findAll()
 * @method UserResetPasswordRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserResetPasswordRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserResetPasswordRequest::class);
    }

    /**
     * @param UserInterface $user
     */
    public function deleteUserResetPasswordRequestByUser(UserInterface $user): void
    {
        $this->createQueryBuilder('urp')
            ->delete()
            ->where('urp.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $resetRequestLifetime
     */
    public function deleteExpiredResetPasswordRequests(int $resetRequestLifetime): void
    {
        $this->createQueryBuilder('urp')
            ->delete()
            ->where("urp.expiresAt < DATE_SUB(CURRENT_DATE(), :requestLifeTime, 'SECOND')")
            ->setParameter('requestLifeTime', $resetRequestLifetime)
            ->getQuery()
            ->execute();
    }
}
