<?php

namespace App\Model\User\Generator;

use App\Model\User\Model\UserResetPasswordTokenComponents;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserResetPasswordTokenGenerator
{
    private string $signingKey;

    public function __construct(string $signingKey)
    {
        $this->signingKey = $signingKey;
    }

    /**
     * @throws \Exception
     */
    public function generate(\DateTimeInterface $expiresAt, UserInterface $user, ?string $verifier = null): UserResetPasswordTokenComponents
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
     * @throws \Exception
     */
    private function getRandomString(): string
    {
        return \md5(\random_bytes(25));
    }

    private function getHashedToken(string $verifier, int $userId, int $expiresAtTimestamp): string
    {
        return \base64_encode(\hash_hmac(
            'sha256',
            \json_encode([$verifier, $userId, $expiresAtTimestamp]),
            $this->signingKey,
            true
        ));
    }
}
