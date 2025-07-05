<?php

namespace App\Model\User\Exception;

final class ExpiredUserResetPasswordTokenException extends \Exception implements UserExceptionInterface
{
    public function getErrorMessage(): string
    {
        return 'Your token is expired.';
    }
}
