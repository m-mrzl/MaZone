<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDetailsController extends AbstractController
{
    /**
     * @Route("/user/details", name="user.details.index")
     */
    public function index(): Response
    {

        $user = $this->getUser();


        return $this->render('user/user.details.html.twig', [
            'controller_name' => 'UserDetailsController',
            'user' => $user,
        ]);
    }
}
