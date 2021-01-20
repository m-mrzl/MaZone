<?php

namespace App\Controller;

use App\Form\ProductSearchType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home.index")
     */
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository, ProvinceRepository $provinceRepository): Response
    {
        $products = $productRepository->findAll();
        $categories = $categoryRepository->findAll();
        $provinces = $provinceRepository->findAll();

        $form = $this->createForm(ProductSearchType::class, null, [
            'action' => $this->generateUrl('products.index')
        ]);

        // dd($form);

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'provinces' => $provinces,
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
}
