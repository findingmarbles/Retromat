<?php

namespace App\Model\User\Exception;

final class InvalidUserResetPasswordTokenException extends \Exception implements UserExceptionInterface
{
    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return 'The token is invalid.';
    }
}
