<?php

declare(strict_types=1);

namespace App\Tests\Model\User;

use App\Entity\UserResetPasswordRequestInterface;
use App\Model\User\Exception\ExpiredUserResetPasswordTokenException;
use App\Model\User\Exception\InvalidUserResetPasswordTokenException;
use App\Model\User\Generator\UserResetPasswordTokenGenerator;
use App\Model\User\Model\UserResetPasswordToken;
use App\Model\User\Model\UserResetPasswordTokenComponents;
use App\Model\User\UserResetPasswordManager;
use App\Repository\UserResetPasswordRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

class UserResetPasswordManagerTest extends TestCase
{
    private MockObject|UserResetPasswordTokenGenerator $tokenGenerator;
    private MockObject|UserResetPasswordRepository $repository;
    private MockObject|EntityManagerInterface $entityManager;
    private UserResetPasswordManager $manager;
    private int $resetRequestLifetime = 3600; // 1 hour

    public function setUp(): void
    {
        $this->tokenGenerator = $this->createMock(UserResetPasswordTokenGenerator::class);
        $this->repository = $this->createMock(UserResetPasswordRepository::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->manager = new UserResetPasswordManager(
            $this->tokenGenerator,
            $this->repository,
            $this->entityManager,
            $this->resetRequestLifetime
        );
    }

    public function testGenerateUserResetPasswordTokenCallsEntityManager(): void
    {
        $user = $this->createMock(UserInterface::class);
        $tokenComponents = new UserResetPasswordTokenComponents(
            'selector-123',
            'verifier-456',
            'hashed-token-789'
        );

        $this->tokenGenerator
            ->expects($this->once())
            ->method('generate')
            ->willReturn($tokenComponents);

        $this->entityManager
            ->expects($this->once())
            ->method('persist');

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $token = $this->manager->generateUserResetPasswordToken($user);

        $this->assertInstanceOf(UserResetPasswordToken::class, $token);
    }

    public function testDeleteExpiredResetRequests(): void
    {
        $this->repository
            ->expects($this->once())
            ->method('deleteExpiredResetPasswordRequests')
            ->with($this->resetRequestLifetime);

        $this->manager->deleteExpiredResetRequests();
    }

    public function testPersistUserResetPasswordRequest(): void
    {
        $userResetPasswordRequest = $this->createMock(UserResetPasswordRequestInterface::class);

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($userResetPasswordRequest);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $this->manager->persist($userResetPasswordRequest);
    }

    public function testPersistThrowsException(): void
    {
        $userResetPasswordRequest = $this->createMock(UserResetPasswordRequestInterface::class);
        $exception = new \Exception('Database error');

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->willThrowException($exception);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Database error');

        $this->manager->persist($userResetPasswordRequest);
    }

    public function testValidateTokenWithInvalidLength(): void
    {
        $invalidToken = 'too-short';

        $this->expectException(InvalidUserResetPasswordTokenException::class);

        $this->manager->validateTokenAndFetchUser($invalidToken);
    }

    public function testValidateTokenWithNonExistentRequest(): void
    {
        $validLengthToken = str_repeat('a', UserResetPasswordTokenComponents::COMPONENTS_LENGTH * 2);

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn(null);

        $this->expectException(InvalidUserResetPasswordTokenException::class);

        $this->manager->validateTokenAndFetchUser($validLengthToken);
    }

    public function testValidateTokenWithExpiredRequest(): void
    {
        $validLengthToken = str_repeat('a', UserResetPasswordTokenComponents::COMPONENTS_LENGTH * 2);
        $expiredRequest = $this->createMock(UserResetPasswordRequestInterface::class);

        $expiredRequest
            ->method('isExpired')
            ->willReturn(true);

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn($expiredRequest);

        $this->expectException(ExpiredUserResetPasswordTokenException::class);

        $this->manager->validateTokenAndFetchUser($validLengthToken);
    }

    public function testDeleteUserResetPasswordRequestWithInvalidToken(): void
    {
        $invalidToken = str_repeat('a', UserResetPasswordTokenComponents::COMPONENTS_LENGTH * 2);

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn(null);

        $this->expectException(InvalidUserResetPasswordTokenException::class);

        $this->manager->deleteUserResetPasswordRequest($invalidToken);
    }

    public function testDeleteUserResetPasswordRequestSuccess(): void
    {
        $validToken = str_repeat('a', UserResetPasswordTokenComponents::COMPONENTS_LENGTH * 2);
        $request = $this->createMock(UserResetPasswordRequestInterface::class);
        $user = $this->createMock(UserInterface::class);

        $request
            ->method('getUser')
            ->willReturn($user);

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn($request);

        $this->repository
            ->expects($this->once())
            ->method('deleteUserResetPasswordRequestByUser')
            ->with($user);

        $this->manager->deleteUserResetPasswordRequest($validToken);
    }
}
