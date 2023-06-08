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

    #[Route('/search', name: 'app_search')]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $destination = $request->query->get('destination');

        
        $rides = $entityManager->getRepository(Ride::class)->findByDestination($destination);

        return $this->render('rides/search.html.twig', [
            'rides' => $rides,
            'destination' => $destination
        ]);
    }

    #[Route('/rides/{id}/edit', name: 'app_edit_ride')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Ride $ride): Response
    {
        $form = $this->createForm(RideType::class, $ride);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rides');
        }

        return $this->render('detail_ride/edit.html.twig', [
            'ride' => $ride,
            'form' => $form->createView()
        ]);
    } 

    #[Route('/rides/{id}/delete', name: 'app_delete_ride')]
    public function delete(EntityManagerInterface $entityManager, Ride $ride): Response
    {
        $entityManager->remove($ride);
        $entityManager->flush();

        return $this->redirectToRoute('app_rides');
    }



}