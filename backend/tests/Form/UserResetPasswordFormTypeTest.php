<?php

declare(strict_types=1);

namespace App\Tests\Form;

use App\Form\UserPasswordType;
use App\Form\UserResetPasswordFormType;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserResetPasswordFormTypeTest extends TestCase
{
    private UserResetPasswordFormType $formType;

    public function setUp(): void
    {
        $this->formType = new UserResetPasswordFormType();
    }

    public function testExtendsUserPasswordType(): void
    {
        $this->assertInstanceOf(UserPasswordType::class, $this->formType);
    }

    public function testConfigureOptions(): void
    {
        $resolver = $this->createMock(OptionsResolver::class);

        $resolver
            ->expects($this->once())
            ->method('setDefaults')
            ->with([]);

        $this->formType->configureOptions($resolver);
    }

    public function testFormTypeHasCorrectClass(): void
    {
        $this->assertInstanceOf(UserResetPasswordFormType::class, $this->formType);
    }

    public function testFormTypeCanBeInstantiated(): void
    {
        $formType = new UserResetPasswordFormType();
        $this->assertInstanceOf(UserResetPasswordFormType::class, $formType);
    }
}
