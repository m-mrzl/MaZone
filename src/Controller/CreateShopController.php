<?php

namespace App\Controller;

use App\Form\ShopType;
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

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
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

            // Persistance en base de données
            $this->manager->persist($newShop);
            $this->manager->flush();

            return $this->redirectToRoute('admin.index');
        }

        return $this->render('shop/create.shop.html.twig', [
            'controller_name' => 'CreateShopController',
            'form' => $form->createView(),
        ]);
    }
}
