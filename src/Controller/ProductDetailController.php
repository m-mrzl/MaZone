<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailController extends AbstractController
{
    /**
     * @Route("/product/detail/{id<\d+>}", name="product.detail.index")
     */
    public function index(int $id, ProductRepository $productRepository, CommentRepository $commentRepository, Request $request, Product $product, EntityManagerInterface $manager): Response
    {
        // requête de produit par id
        $productDetail = $productRepository->find($id);

        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment = $form->getData();

            $comment->setProduct($product);

            $comment->setUser($this->getUser());

            // On persiste l'entité avec le manager
            $manager->persist($comment);
            $manager->flush();

            // Message flash
            $this->addFlash('success', 'Votre commentaire a bien été ajouté.');
        }

        // requête des commentaires par l'id du produit
        $comments = $commentRepository->findBy([
            'product' => $id
        ]);

        // Affichage du templates produit détail
        return $this->render('products/product.detail.html.twig', [
            'controller_name' => 'ProductDetailController',
            'productDetail' => $productDetail,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }


}
