<?php

namespace App\Model\User\Exception;

interface UserExceptionInterface
{
    /**
     * @return string
     */
    public function getErrorMessage(): string;
}
