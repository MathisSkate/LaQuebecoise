<?php

namespace App\Controller;

use App\Entity\DetailVente;
use App\Form\DetailVenteType;
use App\Repository\DetailVenteRepository;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/detail/vente')]
class DetailVenteController extends AbstractController
{
    #[Route('/', name: 'app_detail_vente_index', methods: ['GET'])]
    public function index(DetailVenteRepository $detailVenteRepository): Response
    {
        return $this->render('detail_vente/index.html.twig', [
            'detail_ventes' => $detailVenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detail_vente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DetailVenteRepository $detailVenteRepository, VenteRepository $venteRepository): Response
    {
        $detailVente = new DetailVente();
        $detailVente -> setVente($venteRepository -> findLast());
        $form = $this->createForm(DetailVenteType::class, $detailVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailVenteRepository->add($detailVente);
            $this -> addFlash('success', "Produit ajouté à la vente");
            return $this->redirectToRoute('app_detail_vente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('detail_vente/new.html.twig', [
            'detail_vente' => $detailVente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detail_vente_show', methods: ['GET'])]
    public function show(DetailVente $detailVente): Response
    {
        return $this->render('detail_vente/show.html.twig', [
            'detail_vente' => $detailVente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detail_vente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailVente $detailVente, DetailVenteRepository $detailVenteRepository): Response
    {
        $form = $this->createForm(DetailVenteType::class, $detailVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailVenteRepository->add($detailVente);
            $this -> addFlash('success', "Vente modifié");
            return $this->redirectToRoute('app_detail_vente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('detail_vente/edit.html.twig', [
            'detail_vente' => $detailVente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detail_vente_delete', methods: ['POST'])]
    public function delete(Request $request, DetailVente $detailVente, DetailVenteRepository $detailVenteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailVente->getId(), $request->request->get('_token'))) {
            $detailVenteRepository->remove($detailVente);
            $this -> addFlash('success', "Produit supprimé de la vente");
        }

        return $this->redirectToRoute('app_detail_vente_index', [], Response::HTTP_SEE_OTHER);
    }
}
