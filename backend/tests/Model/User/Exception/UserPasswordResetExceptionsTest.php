<?php

declare(strict_types=1);

namespace App\Tests\Model\User\Exception;

use App\Model\User\Exception\ExpiredUserResetPasswordTokenException;
use App\Model\User\Exception\InvalidUserResetPasswordTokenException;
use PHPUnit\Framework\TestCase;

class UserPasswordResetExceptionsTest extends TestCase
{
    public function testExpiredUserResetPasswordTokenExceptionGetErrorMessage(): void
    {
        $exception = new ExpiredUserResetPasswordTokenException();

        $errorMessage = $exception->getErrorMessage();

        $this->assertNotEmpty($errorMessage);
    }

    public function testInvalidUserResetPasswordTokenExceptionGetErrorMessage(): void
    {
        $exception = new InvalidUserResetPasswordTokenException();

        $errorMessage = $exception->getErrorMessage();

        $this->assertNotEmpty($errorMessage);
    }

    public function testExpiredUserResetPasswordTokenExceptionIsThrowable(): void
    {
        $exception = new ExpiredUserResetPasswordTokenException();

        $this->assertInstanceOf(\Throwable::class, $exception);
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    public function testInvalidUserResetPasswordTokenExceptionIsThrowable(): void
    {
        $exception = new InvalidUserResetPasswordTokenException();

        $this->assertInstanceOf(\Throwable::class, $exception);
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    public function testExceptionsCanBeThrown(): void
    {
        $this->expectException(ExpiredUserResetPasswordTokenException::class);
        throw new ExpiredUserResetPasswordTokenException();
    }

    public function testInvalidExceptionCanBeThrown(): void
    {
        $this->expectException(InvalidUserResetPasswordTokenException::class);
        throw new InvalidUserResetPasswordTokenException();
    }
}
