<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CarType;
use App\Form\RuleType;
use App\Entity\Car;
use App\Entity\Rule;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $car = new Car();
        $carForm = $this->createForm(CarType::class, $car);

        $rule = new Rule();
        $ruleForm = $this->createForm(RuleType::class, $rule);

        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $car = $carForm->getData();
            $car->setOwner($security->getUser())
            ->setCreated(new \DateTime());
            $entityManager->persist($car);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_profile');
        }

        $ruleForm->handleRequest($request);
        if ($ruleForm->isSubmitted() && $ruleForm->isValid()) {
            $rule = $ruleForm->getData();
            $rule->setAuthor($security->getUser());
            $entityManager->persist($rule);
            $entityManager->flush();
           

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'carForm' => $carForm->createView(),
            'ruleForm' => $ruleForm->createView()
        ]);
    }
}
