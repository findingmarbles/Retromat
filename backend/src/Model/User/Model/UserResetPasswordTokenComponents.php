<?php

namespace App\Model\User\Model;

final class UserResetPasswordTokenComponents
{
    public const COMPONENTS_LENGTH = 32;
    private string $selector;
    private string $verifier;
    private string $hashedToken;

    public function __construct(string $selector, string $verifier, string $hashedToken)
    {
        $this->selector = $selector;
        $this->verifier = $verifier;
        $this->hashedToken = $hashedToken;
    }

    public function getSelector(): string
    {
        return $this->selector;
    }

    public function getHashedToken(): string
    {
        return $this->hashedToken;
    }

    public function getPublicToken(): string
    {
        return $this->selector.$this->verifier;
    }
}
