<?php

namespace App\Model\User\Model;

use App\Model\User\Exception\InvalidUserResetPasswordTokenException;
use DateTimeInterface;

final class UserResetPasswordToken
{
    private string|null $token;

    /**
     * @param string $token
     * @param DateTimeInterface $expiresAt
     */
    public function __construct(string $token, \DateTimeInterface $expiresAt)
    {
        $this->token = $token;
    }

    /**
     * @return string
     * @throws InvalidUserResetPasswordTokenException
     */
    public function getToken(): string
    {
        if (null === $this->token) {
            throw new InvalidUserResetPasswordTokenException();
        }

        return $this->token;
    }

    /**
     * @return self
     */
    public function flushToken(): self
    {
        $this->token = null;
        return $this;
    }
}
