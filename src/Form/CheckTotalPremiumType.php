<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckTotalPremiumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add(
                'age',
                TextType::class,
                [
                    'label' => false,
                    'attr' => ['class' => 'trip_departFrom'],
                    'required' => true,
                ]
            )
            ->add(
                'postcode',
                TextType::class,
                [
                    'label' => false,
                    'attr' => ['class' => 'trip_departFrom'],
                    'required' => true,
                ]
            )
            ->add(
                'regNo',
                TextType::class,
                ['label' => false, 'required' => true]
            )
            ->add(
                'filter',
                SubmitType::class,
                ['label' => 'Submit']
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
