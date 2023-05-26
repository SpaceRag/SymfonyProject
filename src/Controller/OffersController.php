<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarType;
use App\Entity\Ride;
use App\Form\RideType;

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

    #[Route('/car', name: 'Car')]
    public function car(): Response
    {
        $Car = new Car();

        $form = $this->createForm(CarType::class, $Car);

        return $this->render('offers/car.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/addride', name: 'Ride')]
    public function ride(): Response
    {
        $Ride = new Ride();

        $form = $this->createForm(RideType::class, $Ride);

        return $this->render('offers/ride.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/rides', name: 'Ride')]
    public function rides(): Response
    {
        $Ride = new Ride();

        $form = $this->createForm(RideType::class, $Ride);

        return $this->render('offers/ride.html.twig', [
            'form' => $form
        ]);
    }
}