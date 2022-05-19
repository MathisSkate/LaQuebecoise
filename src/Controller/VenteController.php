<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Form\VenteType;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vente')]
class VenteController extends AbstractController
{
    #[Route('/', name: 'app_vente_index', methods: ['GET'])]
    public function index(VenteRepository $venteRepository): Response
    {
        return $this->render('vente/index.html.twig', [
            'ventes' => $venteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VenteRepository $venteRepository): Response
    {
        $vente = new Vente();
        $vente -> setDate(new \DateTime('@'.strtotime('now')));
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $venteRepository->add($vente);
            $this -> addFlash('success', 'Vous venez de créer une Vente');
            return $this->redirectToRoute('app_vente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vente/new.html.twig', [
            'vente' => $vente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vente_show', methods: ['GET'])]
    public function show(Vente $vente): Response
    {
        return $this->render('vente/show.html.twig', [
            'vente' => $vente,
        ]);
    }

    #[Route('/{id}', name: 'app_vente_delete', methods: ['POST'])]
    public function delete(Request $request, Vente $vente, VenteRepository $venteRepository): Response
    {
        if ($vente->getDetailVentes()->count() == 0) {
            if ($this->isCsrfTokenValid('delete' . $vente->getId(), $request->request->get('_token'))) {
                $venteRepository->remove($vente);
            }
        } else {
            $this -> addFlash('error', 'Vous ne pouvez pas supprimer une Vente qui contient des Produits');
        }
        return $this->redirectToRoute('app_vente_index', [], Response::HTTP_SEE_OTHER);
    }
}
