<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
            'locations' => $locationRepository->findAll(),
        ]);
    }
}
