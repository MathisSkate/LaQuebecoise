<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carte')]
class CarteController extends AbstractController
{
    #[Route('/', name: 'app_carte_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('carte/index.html.twig', [
            'plats' => $produitRepository->findByValue("Plat"),
            'desserts' => $produitRepository->findByValue("Dessert"),
            'boissons' => $produitRepository->findByValue("Boisson"),
            'frites' => $produitRepository->findByValue("Frite"),
            'autres' => $produitRepository->findByValue("Autre"),
        ]);
    }
}
