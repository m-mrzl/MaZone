<?php

namespace App\Controller;

use App\Form\ShopType;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateShopController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    public function __construct(EntityManagerInterface $manager, UploaderHelper $uploaderHelper)
    {
        $this->manager = $manager;
        $this->uploaderHelper = $uploaderHelper;
    }

    /**
     * @Route("/create/shop", name="create.shop.index")
     */
    public function index(Request $request): Response
    {

        $form = $this->createForm(ShopType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();

            $newShop = $form->getData();

            $newShop->setUser($user);

            $user->setRoles(['ROLE_ADMIN']);

            // Gestion du fichier image : on utilise notre classe de service
            $this->uploaderHelper->uploadShopImage($newShop, $form->get('image')->getData());

            // Persistance en base de données
            $this->manager->persist($newShop);
            $this->manager->flush();

            $this->addFlash('success', 'Votre boutique a bien été créé');

            return $this->redirectToRoute('admin.index');
        }

        return $this->render('shop/create.shop.html.twig', [
            'controller_name' => 'CreateShopController',
            'form' => $form->createView(),
        ]);
    }
}
