<?php

namespace App\Model\User\Generator;

use App\Model\User\Model\UserResetPasswordTokenComponents;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserResetPasswordTokenGenerator
{
    private string $signingKey;

    /**
     * @param string $signingKey
     */
    public function __construct(string $signingKey)
    {
        $this->signingKey = $signingKey;
    }

    /**
     * @param \DateTimeInterface $expiresAt
     * @param UserInterface $user
     * @param string|null $verifier
     * @return UserResetPasswordTokenComponents
     * @throws \Exception
     */
    public function generate(\DateTimeInterface $expiresAt, UserInterface $user, string $verifier = null): UserResetPasswordTokenComponents
    {
        if (null === $verifier) {
            $verifier = $this->getRandomString();
        }

        $selector = $this->getRandomString();
        $hashedToken = $this->getHashedToken(
            $verifier,
            $user->getId(),
            $expiresAt->getTimestamp()
        );

        return new UserResetPasswordTokenComponents(
            $selector,
            $verifier,
            $hashedToken
        );
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getRandomString(): string
    {
        return md5(random_bytes(25));
    }

    /**
     * @param string $verifier
     * @param int $userId
     * @param int $expiresAtTimestamp
     * @return string
     */
    private function getHashedToken(string $verifier, int $userId, int $expiresAtTimestamp): string
    {
        return base64_encode(hash_hmac('sha256',
            json_encode([$verifier, $userId, $expiresAtTimestamp]), $this->signingKey, true));
    }
}
