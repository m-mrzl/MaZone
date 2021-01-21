<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank()
                ],
                ])
            // LASTNAME /////
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            // EMAIL /////
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                new NotBlank()
                ],
            ])
            // PASSWORD/////
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'La confirmation du mot de passe ne correspond pas',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Mot de passe (confirmation)'],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit comporter au moins {{ limit }} caractères.'
                    ])
                 ],
                ])
            // ADDRESS /////
            ->add('userAddress', TextType::class,[
                'label' => 'Adresse',
                'constraints' => [
                    new NotBlank()
                    ],
                ])
            // POSTALCODE /////
            ->add('postalCode', TextType::class,[
                'label' => 'Code Postal',
                'constraints' => [
                    new NotBlank()
                ],
                ])
            // PHONE /////
            ->add('userPhone', TextType::class,[
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank()
                ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
