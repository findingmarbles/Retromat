<?php

namespace App\Model\User\Exception;

final class ExpiredUserResetPasswordTokenException extends \Exception implements UserExceptionInterface
{
    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return 'Your token is expired.';
    }
}
