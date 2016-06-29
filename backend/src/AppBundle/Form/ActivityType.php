<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('phase', ChoiceType::class, ['choices' => array_combine(range(1, 5), range(1, 5))])
            ->add('name')
            ->add('summary')
            ->add('desc')
            ->add('duration')
            ->add('source')
            ->add('more')
            ->add('suitable')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activity'
        ));
    }
}
