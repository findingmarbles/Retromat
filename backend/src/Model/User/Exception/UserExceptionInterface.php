<?php

namespace App\Model\User\Exception;

interface UserExceptionInterface
{
    public function getErrorMessage(): string;
}
