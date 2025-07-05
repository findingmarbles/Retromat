<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;

class UserResetPasswordFormType extends UserPasswordType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
