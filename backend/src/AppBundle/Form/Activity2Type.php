<?php
declare(strict_types=1);

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Activity2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
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
            ->add('name', TextareaType::class, ['attr' => ['cols' => '100', 'rows' => 1]])
            ->add('summary', TextareaType::class, ['attr' => ['cols' => '100', 'rows' => 1]])
            ->add('desc', TextareaType::class, ['label' => 'Description', 'attr' => ['cols' => '100', 'rows' => '10'],])
            ->add('duration', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]])
            ->add('source', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]])
            ->add('more', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]])
            ->add('suitable', TextareaType::class, ['required' => false, 'attr' => ['cols' => '100', 'rows' => 1]]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Activity2',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_activity2';
    }


}
