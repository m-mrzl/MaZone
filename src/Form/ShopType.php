<?php

namespace App\Form;

use App\Entity\Province;
use App\Entity\Shop;
use App\Repository\ProvinceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shopName', TextType::class, [
                'label' => 'Nom de la boutique',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('shopDescription', TextareaType::class, [
                'label' => 'Description de la boutique',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('shopPicture', TextType::class, [
                'label' => 'Logo',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('shopPhone', TextType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('shopAddress', TextType::class, [
                'label' => 'Adresse de la boutique',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('province', EntityType::class, [
                'label' => 'Département',
                'class' => Province::class,
                'choice_label' => 'provinceName',
                'query_builder' => function(ProvinceRepository $provinceRepository) {
                    return $provinceRepository->createQueryBuilder('p')
                        ->orderBy('p.provinceName', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }
}
