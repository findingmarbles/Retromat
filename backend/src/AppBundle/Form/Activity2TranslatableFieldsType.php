<?php
declare(strict_types=1);

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Activity2TranslatableFieldsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('retromatId', TextType::class, ['disabled' => true])
            ->add('name', TextareaType::class, ['attr' => ['cols' => '100', 'rows' => 1]])
            ->add('summary', TextareaType::class, ['attr' => ['cols' => '100', 'rows' => 1]])
            ->add('desc', TextareaType::class, ['label' => 'Description', 'attr' => ['cols' => '100', 'rows' => '10'],]);
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
