<?php


namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdminProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName', TextType::class, [
                'label' => 'Nom du produit',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('productDescription', TextareaType::class, [
                'label' => 'Description du produit',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('productPicture', TextType::class, [
                'label' => 'Image',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du produit',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Nom du produit',
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Category::class,
                'choice_label' => 'label',
                'query_builder' => function(CategoryRepository $categoryRepository) {
                    return $categoryRepository->createQueryBuilder('c')
                        ->orderBy('c.label');
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}