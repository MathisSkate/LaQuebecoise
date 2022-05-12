<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/achat')]
class AchatController extends AbstractController
{
    #[Route('/', name: 'app_achat_index', methods: ['GET'])]
    public function index(AchatRepository $achatRepository): Response
    {
        return $this->render('achat/index.html.twig', [
            'achats' => $achatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_achat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AchatRepository $achatRepository): Response
    {
        $achat = new Achat();
        $achat -> setDate(new \DateTime('@'.strtotime('now')));
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achatRepository->add($achat);
            $this -> addFlash('success', 'Vous venez de créer un Achat');
            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/new.html.twig', [
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achat_show', methods: ['GET'])]
    public function show(Achat $achat): Response
    {
        return $this->render('achat/show.html.twig', [
            'achat' => $achat,
        ]);
    }

    #[Route('/{id}', name: 'app_achat_delete', methods: ['POST'])]
    public function delete(Request $request, Achat $achat, AchatRepository $achatRepository): Response
    {
        if ($achat->getDetailAchats()->count() == 0) {
            if ($this->isCsrfTokenValid('delete' . $achat->getId(), $request->request->get('_token'))) {
                $achatRepository->remove($achat);
                $this -> addFlash('success', 'Vous venez de supprimer un Achat');
            }
        } else {
            $this -> addFlash('error', 'Vous ne pouvez pas supprimer un Achat qui contient des Produits');
        }
        return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
    }
}
