<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index(ProductRepository $productRepository, UserInterface $user, ShopRepository $shopRepository): Response
    {
        $shopId = $user->getShop()->getId();

        //dd($userId);
        $products = $productRepository->findBy(['shop'=> $shopId]);

        $shop = $shopRepository->find($shopId);

        //dd($shop);

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'products' => $products,
            'shop' => $shop,
        ]);
    }
}
