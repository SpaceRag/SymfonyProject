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
use App\Entity\Ride;
use App\Form\RegistrationFormType;




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

        
        $rides = $entityManager->getRepository(Ride::class)->findBy([
            'driver' => $security->getUser()
        ]);

        $rules = $entityManager->getRepository(Rule::class)->findBy([
            'author' => $security->getUser()
        ]);
        

        $user = $security->getUser();
        $car = $user->getCar();
        $user = $this->getUser();


        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'carForm' => $carForm->createView(),
            'ruleForm' => $ruleForm->createView(),
            'rides' => $rides,
            'car' => $car,
            'rules' => $rules
        ]);
    }

    #[Route('/profile/edit', name: 'app_edit_profile')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();

    $form = $this->createForm(RegistrationFormType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('app_profile');
    }

    return $this->render('profile/edit.html.twig', [
        'form' => $form->createView(),
        'registrationForm' => $form->createView(),
    ]);
}
}
