<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ride;
use Doctrine\ORM\EntityManagerInterface;

class DetailRideController extends AbstractController
{
    #[Route('/detail/ride/{id}', name: 'app_detail_ride')]
    public function index($id, EntityManagerInterface $entityManager): Response
    {
        
        // Injecter le EntityManagerInterface comme paramètre de la fonction
					// Récupérer le répertoire de l'entité
					$repository = $entityManager->getRepository(Ride::class);
				
					
					$rides = $repository->findAll();
        
        
        if (!$rides) {
            throw $this->createNotFoundException('Ride non trouvée.');
        }

        return $this->render('detail_ride/index.html.twig', [
            'ride' => $rides,
            'id' => $id,
        ]);
    }
}