<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('retromatId')
            ->add(
                'language',
                ChoiceType::class,
                [
                    'choices' => [
                        'English' => 'en',
                        'Deutsch' => 'de',
                        'Español' => 'es',
                        'Français' => 'fr',
                        'Nederlands' => 'nl',
                    ],
                ]
            )
            ->add('phase', ChoiceType::class, ['choices' => array_combine(range(0, 5), range(0, 5))])
            ->add('name', TextareaType::class, ['attr' => ['cols' => '100', 'rows' => 1]])
            ->add('summary', TextareaType::class, ['attr' => ['cols' => '100', 'rows' => 1]])
            ->add('desc', TextareaType::class, ['label' => 'Description', 'attr' => ['cols' => '100', 'rows' => '10'],])
            ->add('duration', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]])
            ->add('source', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]])
            ->add('more', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]])
            ->add('suitable', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'AppBundle\Entity\Activity']);
    }
}
