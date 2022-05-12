<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\DetailAchat;
use App\Form\DetailAchatType;
use App\Repository\AchatRepository;
use App\Repository\DetailAchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/detail/achat')]
class DetailAchatController extends AbstractController
{
    #[Route('/', name: 'app_detail_achat_index', methods: ['GET'])]
    public function index(DetailAchatRepository $detailAchatRepository): Response
    {
        return $this->render('detail_achat/index.html.twig', [
            'detail_achats' => $detailAchatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detail_achat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DetailAchatRepository $detailAchatRepository, AchatRepository $achatRepository): Response
    {
        $detailAchat = new DetailAchat();
        $detailAchat -> setAchat($achatRepository -> findLast());
        $form = $this->createForm(DetailAchatType::class, $detailAchat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailAchat -> getMatiere() -> setStock($detailAchat -> getMatiere() -> getStock() + $detailAchat -> getQuantite());
            $detailAchatRepository->add($detailAchat);
            $this -> addFlash('success', "Produit ajouté à l'achat");
            return $this->redirectToRoute('app_detail_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('detail_achat/new.html.twig', [
            'detail_achat' => $detailAchat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detail_achat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailAchat $detailAchat, DetailAchatRepository $detailAchatRepository): Response
    {
        $form = $this->createForm(DetailAchatType::class, $detailAchat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailAchatRepository->add($detailAchat);
            $this -> addFlash('success', "Achat modifié");
            return $this->redirectToRoute('app_detail_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('detail_achat/edit.html.twig', [
            'detail_achat' => $detailAchat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detail_achat_delete', methods: ['POST'])]
    public function delete(Request $request, DetailAchat $detailAchat, DetailAchatRepository $detailAchatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailAchat->getId(), $request->request->get('_token'))) {
            $detailAchat -> getMatiere() -> setStock($detailAchat -> getMatiere() -> getStock() - $detailAchat -> getQuantite());
            $detailAchatRepository->remove($detailAchat);
            $this -> addFlash('success', "Produit supprimé de l'achat");
        }

        return $this->redirectToRoute('app_detail_achat_index', [], Response::HTTP_SEE_OTHER);
    }
}
