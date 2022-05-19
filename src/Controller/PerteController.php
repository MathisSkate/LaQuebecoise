<?php

namespace App\Controller;

use App\Entity\Perte;
use App\Form\PerteType;
use App\Repository\PerteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/perte')]
class PerteController extends AbstractController
{
    #[Route('/', name: 'app_perte_index', methods: ['GET'])]
    public function index(PerteRepository $perteRepository): Response
    {
        return $this->render('perte/index.html.twig', [
            'pertes' => $perteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_perte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PerteRepository $perteRepository): Response
    {
        $perte = new Perte();
        $perte -> setDate(new \DateTime('@'.strtotime('now')));
        $form = $this->createForm(PerteType::class, $perte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perteRepository->add($perte);
            $this -> addFlash('success', 'Vous venez de créer une Perte');
            return $this->redirectToRoute('app_perte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perte/new.html.twig', [
            'perte' => $perte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perte_show', methods: ['GET'])]
    public function show(Perte $perte): Response
    {
        return $this->render('perte/show.html.twig', [
            'perte' => $perte,
        ]);
    }

    #[Route('/{id}', name: 'app_perte_delete', methods: ['POST'])]
    public function delete(Request $request, Perte $perte, PerteRepository $perteRepository): Response
    {
        if ($perte->getDetailPertes()->count() == 0) {
            if ($this->isCsrfTokenValid('delete' . $perte->getId(), $request->request->get('_token'))) {
                $perteRepository->remove($perte);
                $this -> addFlash('success', 'Vous venez de supprimer une Perte');
            }
        } else {
            $this -> addFlash('error', 'Vous ne pouvez pas supprimer une Perte qui contient des Produits');
        }

        return $this->redirectToRoute('app_perte_index', [], Response::HTTP_SEE_OTHER);
    }
}
