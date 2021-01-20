<?php

namespace App\Controller;

use App\Form\ProductSearchType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id<\d+>}", name="category.index")
     */
    public function index(int $id, ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {

        $productsByCategory = $productRepository->findBy([
            'category' => $id,
        ]);

        $form = $this->createForm(ProductSearchType::class, null, [
            'action' => $this->generateUrl('products.index')
        ]);

        $category = $categoryRepository->findBy([
            'id' => $id
        ]);

        $categoryName = $category[0]->getLabel();



        return $this->render('products/category.html.twig', [
            'controller_name' => 'CategoryController',
            'productsByCategory' => $productsByCategory,
            'form' => $form->createView(),
            'categoryName' => $categoryName,
        ]);
    }
}
