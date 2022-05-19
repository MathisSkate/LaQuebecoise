<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MouvementController extends AbstractController
{
    #[Route('/mouvement', name: 'app_mouvement')]
    public function index(): Response
    {
        return $this->render('mouvement/index.html.twig', [
            'controller_name' => 'MouvementController',
        ]);
    }
}
