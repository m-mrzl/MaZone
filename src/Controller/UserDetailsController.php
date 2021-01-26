<?php

namespace App\Controller;

use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDetailsController extends AbstractController
{
    /**
     * @Route("/user/details", name="user.details.index")
     */
    public function index(ShopRepository $shopRepository): Response
    {

        $user = $this->getUser();

        $shopDetail = null;
        $province = null;

        if ($user->hasRole('ROLE_ADMIN')) {

            $shopId = $user->getShop()->getId();

            $shop = $shopRepository->findBy(['id' => $shopId]);

            $shopDetail = $shop[0];

            $province = $shopDetail->getProvince()->getProvinceName();
        }



        return $this->render('user/user.details.html.twig', [
            'controller_name' => 'UserDetailsController',
            'user' => $user,
            'shopDetail' => $shopDetail,
            'province' => $province,
        ]);
    }
}
