<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Ride;

class DetailRideController extends AbstractController
{
    #[Route('/detail/ride/{id}', name: 'app_detail_ride')]
    public function index($id, EntityManagerInterface $entityManager): Response
    {
        
        $ride = $entityManager->getRepository(Ride::class)->find($id);

        
        if (!$ride) {
            throw $this->createNotFoundException('Ride non trouvée.');
        }

        return $this->render('detail_ride/index.html.twig', [
            'ride' => $ride,
        ]);
    }
}
