<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/{id<\d+>}", name="shop.index")
     */
    public function index(int $id, ProductRepository $productRepository, ShopRepository $shopRepository): Response
    {

        $productsByShop = $productRepository->findBy(['shop' => $id]);

        $shop = $shopRepository->findBy(['id' => $id]);

        $shopName = $shop[0]->getShopName();

        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
            'productsByShop' => $productsByShop,
            'shopName' => $shopName,
        ]);
    }
}
