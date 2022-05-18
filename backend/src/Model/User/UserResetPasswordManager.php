<?php

namespace App\Model\User;

use App\Entity\UserResetPasswordRequest;
use App\Entity\UserResetPasswordRequestInterface;
use App\Model\User\Exception\ExpiredUserResetPasswordTokenException;
use App\Model\User\Exception\InvalidUserResetPasswordTokenException;
use App\Model\User\Generator\UserResetPasswordTokenGenerator;
use App\Model\User\Model\UserResetPasswordToken;
use App\Model\User\Model\UserResetPasswordTokenComponents;
use App\Repository\UserResetPasswordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserResetPasswordManager
{
    private UserResetPasswordTokenGenerator $userResetPasswordTokenGenerator;
    private UserResetPasswordRepository $userResetPasswordRequestRepository;
    private int $resetRequestLifetime;
    private EntityManagerInterface $entityManager;

    /**
     * @param UserResetPasswordTokenGenerator $userResetPasswordTokenGenerator
     * @param UserResetPasswordRepository $userResetPasswordRequestRepository
     * @param EntityManagerInterface $entityManager
     * @param int $resetRequestLifetime
     */
    public function __construct(
        UserResetPasswordTokenGenerator $userResetPasswordTokenGenerator,
        UserResetPasswordRepository $userResetPasswordRequestRepository,
        EntityManagerInterface $entityManager,
        int $resetRequestLifetime
    ) {
        $this->userResetPasswordTokenGenerator = $userResetPasswordTokenGenerator;
        $this->userResetPasswordRequestRepository = $userResetPasswordRequestRepository;
        $this->entityManager = $entityManager;
        $this->resetRequestLifetime = $resetRequestLifetime;
    }

    /**
     * @param UserInterface $user
     * @return UserResetPasswordToken
     * @throws \Exception
     */
    public function generateUserResetPasswordToken(UserInterface $user): UserResetPasswordToken
    {
        $expiresAt = new \DateTimeImmutable(sprintf('+%d seconds', $this->resetRequestLifetime));
        $tokenComponents = $this->userResetPasswordTokenGenerator->generate(
            $expiresAt,
            $user
        );

        $userResetPasswordRequest = new UserResetPasswordRequest(
            $user,
            $expiresAt,
            $tokenComponents->getSelector(),
            $tokenComponents->getHashedToken()
        );

        $this->persist($userResetPasswordRequest);

        return new UserResetPasswordToken(
            $tokenComponents->getPublicToken(),
            $expiresAt
        );
    }

    /**
     * @param string $fullToken
     * @return UserInterface
     * @throws ExpiredUserResetPasswordTokenException
     * @throws InvalidUserResetPasswordTokenException
     */
    public function validateTokenAndFetchUser(string $fullToken): UserInterface
    {
        if (UserResetPasswordTokenComponents::COMPONENTS_LENGTH*2 !== \strlen($fullToken)) {
            throw new InvalidUserResetPasswordTokenException();
        }

        $resetRequest = $this->findUserResetPasswordRequest($fullToken);
        if (null === $resetRequest) {
            throw new InvalidUserResetPasswordTokenException();
        }

        if ($resetRequest->isExpired()) {
            throw new ExpiredUserResetPasswordTokenException();
        }

        $user = $resetRequest->getUser();

        $hashedVerifierToken = $this->userResetPasswordTokenGenerator->generate(
            $resetRequest->getExpiresAt(),
            $user,
            substr($fullToken, UserResetPasswordTokenComponents::COMPONENTS_LENGTH)
        );

        if (false === hash_equals($resetRequest->getHashedToken(), $hashedVerifierToken->getHashedToken())) {
            throw new InvalidUserResetPasswordTokenException();
        }

        return $user;
    }

    /**
     * @param string $fullToken
     * @throws InvalidUserResetPasswordTokenException
     */
    public function deleteUserResetPasswordRequest(string $fullToken): void
    {
        $userResetPasswordRequest = $this->findUserResetPasswordRequest($fullToken);
        if (null === $userResetPasswordRequest) {
            throw new InvalidUserResetPasswordTokenException();
        }

        $this->userResetPasswordRequestRepository->deleteUserResetPasswordRequestByUser($userResetPasswordRequest->getUser());
    }

    /**
     * @param UserResetPasswordRequestInterface $userResetPasswordRequest
     * @throws \Exception
     */
    public function persist(UserResetPasswordRequestInterface $userResetPasswordRequest): void
    {
        try {
            $this->entityManager->persist($userResetPasswordRequest);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $token
     * @return UserResetPasswordRequestInterface|null
     */
    private function findUserResetPasswordRequest(string $token): ?UserResetPasswordRequestInterface
    {
        return $this->userResetPasswordRequestRepository->findOneBy(
            [
                'selector' => substr($token, 0, UserResetPasswordTokenComponents::COMPONENTS_LENGTH)
            ]
        );
    }

    /**
     * @return void
     */
    public function deleteExpiredResetRequests(): void
    {
        $this->userResetPasswordRequestRepository->deleteExpiredResetPasswordRequests($this->resetRequestLifetime);
    }
}
