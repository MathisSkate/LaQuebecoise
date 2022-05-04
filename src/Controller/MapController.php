<?php

namespace App\Controller;

use App\Repository\LocalisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function index(LocalisationRepository $localisationRepository): Response
    {
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
            'localisations' => $localisationRepository->findAll(),
        ]);
    }
}
