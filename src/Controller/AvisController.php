<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avis')]
class AvisController extends AbstractController
{
    #[Route('/', name: 'app_avis_index', methods: ['GET'])]
    public function index(AvisRepository $avisRepository): Response
    {
        return $this->render('avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_avis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AvisRepository $avisRepository): Response
    {
        if(empty($avisRepository->findBy(array('ip' => $request->getClientIp())))) {
        print_r($request->getClientIp());
        $avi = new Avis();
        $avi -> setDate(new \DateTime('@'.strtotime('now')));
        $avi ->setIp($request->getClientIp());
            $form = $this->createForm(AvisType::class, $avi);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $avisRepository->add($avi);
                return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('avis/new.html.twig', [
                'avi' => $avi,
                'form' => $form,
            ]);
        } else {
            $this->addFlash('error', 'Vous avez déjà donné votre avis !');
            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }
    }

    #[Route('/{id}', name: 'app_avis_show', methods: ['GET'])]
    public function show(Avis $avi): Response
    {
        return $this->render('avis/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_avis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avi, AvisRepository $avisRepository): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avisRepository->add($avi);
            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avis_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, AvisRepository $avisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $avisRepository->remove($avi);
        }

        return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
    }
}
