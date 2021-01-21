<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailController extends AbstractController
{
    /**
     * @Route("/product/detail/{id<\d+>}", name="product.detail.index")
     */
    public function index(int $id, ProductRepository $productRepository, CommentRepository $commentRepository): Response
    {
        // requête de produit par id
        $productDetail = $productRepository->find($id);

        // requête des commentaires par l'id du produit
        $comments = $commentRepository->findBy([
            'product' => $id
        ]);


        // Affichage du templates produit détail
        return $this->render('products/product.detail.html.twig', [
            'controller_name' => 'ProductDetailController',
            'productDetail' => $productDetail,
            'comments' => $comments,
        ]);
    }
}
