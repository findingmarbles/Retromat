<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('retromatId', TextType::class, ['disabled' => true])
            ->add(
                'phase',
                ChoiceType::class,
                [
                    'choices' => [
                        '0 Set the stage' => 0,
                        '1 Gather data' => 1,
                        '2 Generate Insight' => 2,
                        '3 Decide what to do' => 3,
                        '4 Close' => 4,
                        '5 Something completely different' => 5,
                    ],
                ]
            )
            ->add('name', TextareaType::class)
            ->add('summary', TextareaType::class)
            ->add('desc', TextareaType::class)
            ->add('duration', TextareaType::class, ['required' => false])
            ->add('source', TextareaType::class, ['required' => false])
            ->add('more', TextareaType::class, ['required' => false])
            ->add('stage', TextareaType::class, ['required' => false])
            ->add('suitable', TextareaType::class, ['required' => false])
            ->add('forumUrl', TextareaType::class, ['required' => false]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_activity';
    }
}
