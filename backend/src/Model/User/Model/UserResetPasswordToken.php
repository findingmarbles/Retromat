<?php

namespace App\Model\User\Model;

use App\Model\User\Exception\InvalidUserResetPasswordTokenException;

final class UserResetPasswordToken
{
    private ?string $token;

    public function __construct(string $token, \DateTimeInterface $expiresAt)
    {
        $this->token = $token;
    }

    /**
     * @throws InvalidUserResetPasswordTokenException
     */
    public function getToken(): string
    {
        if (null === $this->token) {
            throw new InvalidUserResetPasswordTokenException();
        }

        return $this->token;
    }

    public function flushToken(): self
    {
        $this->token = null;

        return $this;
    }
}
