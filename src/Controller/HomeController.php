<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        dd($products);
        return $this->render('home/index.html.twig', [
            'products' => $products,
            'controller_name' => 'HomeController',
        ]);
    }
}
