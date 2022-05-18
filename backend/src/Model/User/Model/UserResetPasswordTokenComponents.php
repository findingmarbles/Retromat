<?php

namespace App\Model\User\Model;

final class UserResetPasswordTokenComponents
{
    public const COMPONENTS_LENGTH = 32;
    private string $selector;
    private string $verifier;
    private string $hashedToken;

    /**
     * @param string $selector
     * @param string $verifier
     * @param string $hashedToken
     */
    public function __construct(string $selector, string $verifier, string $hashedToken)
    {
        $this->selector = $selector;
        $this->verifier = $verifier;
        $this->hashedToken = $hashedToken;
    }

    /**
     * @return string
     */
    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * @return string
     */
    public function getHashedToken(): string
    {
        return $this->hashedToken;
    }

    /**
     * @return string
     */
    public function getPublicToken(): string
    {
        return $this->selector.$this->verifier;
    }
}
