<?php

namespace App\Controller\Admin;

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

        $NewProduct = null;


        if ($form->isSubmitted() && $form->isValid()) {

            ///                             //////////////
            $NewProduct = $form->getData();


            dd($NewProduct);
            ////                            //////////////

            // Persistance en base de données
            $this->manager->persist($NewProduct);
            $this->manager->flush();

            return $this->redirectToRoute('admin.index');

        }




        return $this->render('admin/new.html.twig', [
            'controller_name' => 'AdminProductController',
            'form' => $form->createView(),
        ]);

    }
}
