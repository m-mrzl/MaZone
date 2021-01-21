<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
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
     * @Route("/signup", name="signup.index")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        // Création de l'objet UserType (formulaire)
        $form = $this->createForm(UserType::class);

        // Injection des données de la requête HTTP (du formulaire) dans l'objet UserType
        $form->handleRequest($request);

        $user = null;

        // Si le formulaire est soumis et valide (correctement rempli)
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            // On récupère le mot de passe en clair rentré par l'internaute dans le formulaire
            $plainPassword = $form->get('plainPassword')->getData();

            // Hashage du mot de passe
            $hashedPassword = $encoder->encodePassword($user, $plainPassword);

            // Affectation du mot de passe hashé au champ password de l'entité User
            $user->setPassword($hashedPassword);

            // Persistance en base de données
            $this->manager->persist($user);
            $this->manager->flush();

            // message flash
            $this->addFlash('success', ' Votre compte a été créé avec succès. ');
            return $this->redirectToRoute('security.login');

        }


        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
        ]);
    }
}
