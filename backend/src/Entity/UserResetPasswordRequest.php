<?php

namespace App\Entity;

use App\Repository\UserResetPasswordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user_reset_password_request")
 * @ORM\Entity(repositoryClass=UserResetPasswordRepository::class)
 */
class UserResetPasswordRequest implements UserResetPasswordRequestInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private UserInterface $user;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected string $selector;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $hashedToken;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    protected \DateTimeImmutable $requestedAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    protected \DateTimeInterface $expiresAt;

    public function __construct(UserInterface $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken)
    {
        $this->user = $user;
        $this->requestedAt = new \DateTimeImmutable('now');
        $this->expiresAt = $expiresAt;
        $this->selector = $selector;
        $this->hashedToken = $hashedToken;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getRequestedAt(): \DateTimeInterface
    {
        return $this->requestedAt;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expiresAt->getTimestamp() <= \time();
    }

    /**
     * @return \DateTimeInterface
     */
    public function getExpiresAt(): \DateTimeInterface
    {
        return $this->expiresAt;
    }

    /**
     * @return string
     */
    public function getHashedToken(): string
    {
        return $this->hashedToken;
    }
}
