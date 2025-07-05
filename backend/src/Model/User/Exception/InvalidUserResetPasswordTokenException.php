<?php

namespace App\Model\User\Exception;

final class InvalidUserResetPasswordTokenException extends \Exception implements UserExceptionInterface
{
    public function getErrorMessage(): string
    {
        return 'The token is invalid.';
    }
}
