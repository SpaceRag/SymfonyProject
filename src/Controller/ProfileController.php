<?php

namespace App\Controller;

use App\Form\RuleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CarType;


class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $carForm = $this->createForm(CarType::class);
        $ruleForm = $this->createForm(RuleType::class);

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'carForm' => $carForm->createView(),
            'ruleForm' =>$ruleForm->createView()

        ]);
    }
}
