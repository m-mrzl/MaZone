<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart.index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity){
            $panierWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierWithData as $item) {
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $panierWithData,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/panier/add/{id<\d+>}", name="cart.add")
     */
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {

            $panier[$id]++;

        } else {

            $panier[$id] = 1;
        }


        $session->set('panier', $panier);

        return $this->redirectToRoute('cart.index');
    }

    /**
     * @Route("/panier/remove/{id<\d+>}", name="cart.remove")
     */
    public function remove($id, SessionInterface $session) {

        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("cart.index");
    }
}
