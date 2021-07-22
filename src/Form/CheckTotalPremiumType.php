<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

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
                    'required' => true,
                    'constraints' => [
                        new Length(['min' => 6, 'max' => 10]),
                        new Regex([
                            'pattern'   => '/^[0-9A-Z\s]+$/',
                            'match'     => true,
                            'message'   => 'The postcode must contain only Capital letters, numbers and space.'
                        ])
                    ]
                ]
            )
            ->add(
                'regNo',
                TextType::class,
                [
                    'label' => false,
                    'attr' => ['class' => '', 'placeholder' => 'Car regNo'],
                    'required' => true,
                    'constraints' => [
                        new Regex([
                            'pattern'   => '/^[0-9A-Za-z\s]+$/',
                            'match'     => true,
                            'message'   => 'The vehicle reg. number must contain only letters, numbers and space.'
                        ])
                    ]
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
