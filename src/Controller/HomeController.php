<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository, ProvinceRepository $provinceRepository): Response
    {
        $products = $productRepository->findAll();
        $categories = $categoryRepository->findAll();
        $provinces = $provinceRepository->findAll();

        // dd($products);
        $form = $this->createForm(SearchType::class);
        return $this->render('home/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'provinces' => $provinces,
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
}
