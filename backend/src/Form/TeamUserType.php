<?php

namespace App\Form;

use App\Entity\User;
use App\Model\User\UserManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TeamUserType extends AbstractType
{
    public const USERNAME_LENGTH_MIN = 3;
    public const USERNAME_LENGTH_MAX = 20;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => self::USERNAME_LENGTH_MIN,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => self::USERNAME_LENGTH_MAX,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a email address',
                    ]),
                    new Email([
                        'message' => 'Invalid email address',
                    ]),
                ],
            ])
            ->add('enabled')
            ->add('roles', ChoiceType::class, [
                'choices' => $this->getRolesCombined(),
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    /**
     * @return array|string[]
     */
    private function getRolesCombined(): array
    {
        return \array_combine(UserManager::ROLES, UserManager::ROLES);
    }
}
