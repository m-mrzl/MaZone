<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Province;
use App\Repository\CategoryRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departement', EntityType::class, [
                'label' => 'Département',
                'class' => Province::class,
                'choice_label' => 'provinceName',
                'query_builder' => function(ProvinceRepository $provinceRepository) {
                    return $provinceRepository->createQueryBuilder('p')
                        ->orderBy('p.provinceName', 'ASC');
                }
            ])
            ->add('categorie', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Category::class,
                'choice_label' => 'label',
                'query_builder' => function(CategoryRepository $categoryRepository) {
                    return $categoryRepository->createQueryBuilder('c')
                        ->orderBy('c.label');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
