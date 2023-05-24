<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/offers')]

class OffersController extends AbstractController
{
    #[Route('/', name: 'offers')]
    public function offers(): Response
    {
        $pageTitle = 'Offers';
        return $this->render('offers/offers.html.twig', [
            'controller_name' => 'OffersController',
            'title' => $pageTitle
        ]);
    }

    #[Route('/detail', name: 'offersDetail')]
    public function detail(): Response
    {
        $pageTitle = 'Detail';
        return $this->render('offers/detail.html.twig', [
            'controller_name' => 'OffersController',
            'title' => $pageTitle
        ]);
    }

    #[Route('/test', name: 'offersTest')]
    public function test(): Response
    {
        $pageTitle = 'Test';
        return $this->render('offers/test.html.twig', [
            'controller_name' => 'OffersController',
            'title' => $pageTitle
        ]);
    }
}