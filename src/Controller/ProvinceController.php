<?php

namespace App\Controller;

use App\Form\ProductSearchType;
use App\Repository\ProductRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProvinceController extends AbstractController
{
    /**
     * @Route("/province/{id<\d+>}", name="province.index")
     */
    public function index(int $id, ProductRepository $productRepository, ProvinceRepository $provinceRepository): Response
    {

        $productsByProvince = $productRepository->findBy([
            'province' => $id,
        ]);

        $form = $this->createForm(ProductSearchType::class, null, [
            'action' => $this->generateUrl('products.index')
        ]);

        $province = $provinceRepository->findBy([
            'id' => $id
        ]);

        $provinceName = $province[0]->getProvinceName();


        return $this->render('products/province.html.twig', [
            'controller_name' => 'ProvinceController',
            'productsByProvince' => $productsByProvince,
            'form' => $form->createView(),
            'provinceName' => $provinceName,
        ]);
    }
}
