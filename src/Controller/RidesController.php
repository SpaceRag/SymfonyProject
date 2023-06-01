<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ride;
use App\Form\RideType;

class RidesController extends AbstractController
{
    #[Route('/rides', name: 'app_rides')]
    public function index(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $ride = new Ride();
        $rideform = $this->createForm(RideType::class, $ride);

        $rideform->handleRequest($request);
        if ($rideform->isSubmitted() && $rideform->isValid()) {
            $ride = $rideform->getData();
            $ride->setCreated(new \DateTime());
            $ride->setDriver($security->getUser());
            $entityManager->persist($ride);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('rides/index.html.twig', [
            'controller_name' => 'RidesController',
            'rideform' => $rideform->createView()
        ]);
    }
}
