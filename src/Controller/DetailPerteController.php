<?php

namespace App\Controller;

use App\Entity\DetailPerte;
use App\Form\DetailPerteType;
use App\Repository\DetailPerteRepository;
use App\Repository\PerteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/detail/perte')]
class DetailPerteController extends AbstractController
{
    #[Route('/', name: 'app_detail_perte_index', methods: ['GET'])]
    public function index(DetailPerteRepository $detailPerteRepository): Response
    {
        return $this->render('detail_perte/index.html.twig', [
            'detail_pertes' => $detailPerteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detail_perte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DetailPerteRepository $detailPerteRepository, PerteRepository $perteRepository): Response
    {
        $detailPerte = new DetailPerte();
        $detailPerte -> setPerte($perteRepository -> findLast());
        $form = $this->createForm(DetailPerteType::class, $detailPerte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailPerte -> getMatiere() -> setStock($detailPerte -> getMatiere() -> getStock() - $detailPerte -> getQuantite());
            $detailPerteRepository->add($detailPerte);
            $this -> addFlash('success', "Produit ajouté à la perte");
            return $this->redirectToRoute('app_detail_perte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('detail_perte/new.html.twig', [
            'detail_perte' => $detailPerte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detail_perte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailPerte $detailPerte, DetailPerteRepository $detailPerteRepository): Response
    {
        $oldStock = $detailPerte-> getQuantite();
        $form = $this->createForm(DetailPerteType::class, $detailPerte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailPerte -> getMatiere() -> setStock($detailPerte -> getMatiere() -> getStock() + $oldStock);
            $detailPerte -> getMatiere() -> setStock($detailPerte -> getMatiere() -> getStock() - $detailPerte -> getQuantite());
            $detailPerteRepository->add($detailPerte);
            $this -> addFlash('success', "Perte modifié");
            return $this->redirectToRoute('app_detail_perte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('detail_perte/edit.html.twig', [
            'detail_perte' => $detailPerte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detail_perte_delete', methods: ['POST'])]
    public function delete(Request $request, DetailPerte $detailPerte, DetailPerteRepository $detailPerteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailPerte->getId(), $request->request->get('_token'))) {
            $detailPerte -> getMatiere() -> setStock($detailPerte -> getMatiere() -> getStock() + $detailPerte -> getQuantite());
            $detailPerteRepository->remove($detailPerte);
            $this -> addFlash('success', "Produit supprimé de la perte");
        }

        return $this->redirectToRoute('app_detail_perte_index', [], Response::HTTP_SEE_OTHER);
    }
}
