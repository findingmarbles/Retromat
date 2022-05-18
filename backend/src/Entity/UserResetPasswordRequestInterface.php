<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserResetPasswordRequestInterface
{
    public function getRequestedAt(): \DateTimeInterface;
    public function isExpired(): bool;
    public function getExpiresAt(): \DateTimeInterface;
    public function getHashedToken(): string;
    public function getUser(): UserInterface;
}
