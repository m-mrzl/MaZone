<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\AdminProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {

        $this->manager = $manager;
    }


    /**
     * @Route("/admin/new", name="admin.new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(AdminProductType::class);


        // Injection des données de la requête HTTP (du formulaire) dans l'objet ProductSearchType
        $form->handleRequest($request);

        $newProduct = null;

        if ($form->isSubmitted() && $form->isValid()) {

            // récupérer le shopName  ///
            $shopName = $this->getUser()->getShop()->getShopName();

            // récupérer le provinceName  ///
            $provinceName = $this->getUser()->getShop()->getProvince()->getProvinceName();

        // dd($provinceName, $shopName);

            $newProduct = $form->getData();


            // Persistance en base de données
          // $this->manager->persist($newProduct);
          //$this->manager->flush();

            return $this->redirectToRoute('admin.index');

        }

        return $this->render('admin/new.html.twig', [
            'controller_name' => 'AdminProductController',
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/admin/edit/{id<\d+>}", name="admin.edit")
     */
    public function edit(Product $product, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AdminProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->flush();

            // Message flash
            $this->addFlash('success', 'Produit mis à jour.');

            // Redirection vers le dashboard admin
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/remove/{id<\d+>}", name="admin.remove")
     */
    public function remove(Product $product, EntityManagerInterface $manager)
    {


        $manager->remove($product);
        $manager->flush();

        // Message flash
        $this->addFlash('success', 'Produit supprimé.');

        // Redirection vers le dashboard admin
        return $this->redirectToRoute('admin.index');
    }
}
