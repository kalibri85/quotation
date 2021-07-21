<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                IntegerType::class,
                [
                    'label' => false,
                    'attr' => ['class' => '', 'placeholder' => 'Age', 'min' => 17, 'max' => 70],
                    'required' => true,
                ]
            )
            ->add(
                'postcode',
                TextType::class,
                [
                    'label' => false,
                    'attr' => ['class' => '', 'placeholder' => 'Postcode'],
                    'required' => true
                ]
            )
            ->add(
                'regNo',
                TextType::class,
                [
                    'label' => false, 
                    'attr' => ['class' => '', 'placeholder' => 'Car regNo'],
                    'required' => true
                ]
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
