<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    /**
     * @Route("/mentionslegales", name="mentionsLegales.index")
     */
    public function index(): Response
    {
        return $this->render('mentions_legales/mentionsLegales.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
}
