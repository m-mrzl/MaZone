<?php

namespace App\Controller;

use App\Form\ProductSearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id<\d+>}", name="category.index")
     */
    public function index(int $id, ProductRepository $productRepository): Response
    {

        $productsByCategory = $productRepository->findBy([
            'category' => $id
        ]);

        $form = $this->createForm(ProductSearchType::class);



        return $this->render('products/category.html.twig', [
            'controller_name' => 'CategoryController',
            'productsByCategory' => $productsByCategory,
            'form' => $form->createView(),
        ]);
    }
}
