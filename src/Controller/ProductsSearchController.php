<?php

namespace App\Controller;

use App\Form\ProductSearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsSearchController extends AbstractController
{
    /**
     * @Route("/products", name="products.index")
     */
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductSearchType::class);

        $form->handleRequest($request);

        $products = null;

        if ($form->isSubmitted()) {

            $search = $form->getData();

            $provinceId = $search['departement']->getId();

            $categoryId = $search['categorie']->getId();


            $products = $productRepository->findBy([
                'province' => $provinceId,
                'category' => $categoryId
            ]);

        }


        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsSearchController',
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }
}
