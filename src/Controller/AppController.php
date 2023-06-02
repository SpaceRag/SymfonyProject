<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarType;
use App\Entity\Ride;
use Doctrine\ORM\EntityManagerInterface;

class AppController extends AbstractController
{
    #[Route('/', name: 'offers')]
    public function offers(EntityManagerInterface $entityManager): Response
    {
        // Injecter le EntityManagerInterface comme paramètre de la fonction
					// Récupérer le répertoire de l'entité Product
					$repository = $entityManager->getRepository(Ride::class);
				
					// Cherche plusieurs produits avec un nom correspondant, trier par prix
					$rides = $repository->findAll();

                    
					
        $pageTitle = 'Offers';
        return $this->render('offers/offers.html.twig', [
            'controller_name' => 'OffersController',
            'title' => $pageTitle,
            'rides' => $rides
        ]);
    }

    #[Route('/addcar', name: 'Car')]
    public function car(): Response
    {
        $Car = new Car();

        $form = $this->createForm(CarType::class, $Car);

        return $this->render('offers/car.html.twig', [
            'form' => $form
        ]);
    }

}