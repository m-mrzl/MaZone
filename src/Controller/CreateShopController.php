<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateShopController extends AbstractController
{
    /**
     * @Route("/create/shop", name="create_shop")
     */
    public function index(): Response
    {
        return $this->render('create_shop/index.html.twig', [
            'controller_name' => 'CreateShopController',
        ]);
    }
}
