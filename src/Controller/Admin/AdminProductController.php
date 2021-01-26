<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\AdminProductType;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\UploaderHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminProductController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;
    /**
     * @var SluggerInterface
     */
    private $slugger;

    public function __construct(EntityManagerInterface $manager, UploaderHelper $uploaderHelper, SluggerInterface $slugger)
    {
        $this->manager = $manager;
        $this->uploaderHelper = $uploaderHelper;
        $this->slugger = $slugger;
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

            // récupérer le shop  ///
            $shop = $this->getUser()->getShop();

            // récupérer le province  ///
            $province = $this->getUser()->getShop()->getProvince();


            $newProduct = $form->getData();

            $newProduct->setShop($shop);
            $newProduct->setProvince($province);

            // Gestion du slug
            $slug = $this->slugger->slug($newProduct->getProductName());
            $newProduct->setSlug($slug);

            // Gestion du fichier image : on utilise notre classe de service
            $this->uploaderHelper->uploadProductImage($newProduct, $form->get('image')->getData());

            // Persistance en base de données
            $this->manager->persist($newProduct);
            $this->manager->flush();

            $this->addFlash('success', 'Votre produit a bien été ajouté');

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

            // Gestion du fichier image : on utilise notre classe de service
            $this->uploaderHelper->uploadProductImage($product, $form->get('image')->getData());

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
