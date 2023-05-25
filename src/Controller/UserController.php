<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;

#[Route('/offers')]

class UserController extends AbstractController
{
    #[Route('/', name: 'User')]
    public function user(): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        return $this->render('user.html.twig', [
            'form' => $form
        ]);
    }
}

