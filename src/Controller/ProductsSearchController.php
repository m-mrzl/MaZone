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
        // Création de l'objet ProductSearchType (formulaire)
        $form = $this->createForm(ProductSearchType::class);

        // Injection des données de la requête HTTP (du formulaire) dans l'objet ProductSearchType
        $form->handleRequest($request);

        $products = null;
        $provinceName = null;
        $categoryName = null;

        // Si le formulaire est soumis et valide (correctement rempli)
        if ($form->isSubmitted() && $form->isValid()) {

            $search = $form->getData();

            $provinceId = $search['departement']->getId();

            $categoryId = $search['categorie']->getId();

            $provinceName = $search['departement']->getProvinceName();
            $categoryName = $search['categorie']->getLabel();


            $products = $productRepository->findBy([
                'province' => $provinceId,
                'category' => $categoryId
            ]);

        }


        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsSearchController',
            'products' => $products,
            'provinceName' => $provinceName,
            'categoryName' => $categoryName,
            'form' => $form->createView(),
        ]);
    }
}
