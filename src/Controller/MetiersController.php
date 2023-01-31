<?php

namespace App\Controller;

use App\Entity\Metiers;
use App\Form\MetiersType;
use App\Repository\MetiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/metiers')]
class MetiersController extends AbstractController
{
    #[Route('/', name: 'app_metiers_index', methods: ['GET'])]
    public function index(MetiersRepository $metiersRepository): Response
    {
        return $this->render('metiers/index.html.twig', [
            'metiers' => $metiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_metiers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MetiersRepository $metiersRepository): Response
    {
        $metier = new Metiers();
        $form = $this->createForm(MetiersType::class, $metier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metiersRepository->save($metier, true);

            return $this->redirectToRoute('app_metiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('metiers/new.html.twig', [
            'metier' => $metier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_metiers_show', methods: ['GET'])]
    public function show(Metiers $metier): Response
    {
        return $this->render('metiers/show.html.twig', [
            'metier' => $metier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_metiers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Metiers $metier, MetiersRepository $metiersRepository): Response
    {
        $form = $this->createForm(MetiersType::class, $metier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metiersRepository->save($metier, true);

            return $this->redirectToRoute('app_metiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('metiers/edit.html.twig', [
            'metier' => $metier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_metiers_delete', methods: ['POST'])]
    public function delete(Request $request, Metiers $metier, MetiersRepository $metiersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metier->getId(), $request->request->get('_token'))) {
            $metiersRepository->remove($metier, true);
        }

        return $this->redirectToRoute('app_metiers_index', [], Response::HTTP_SEE_OTHER);
    }
}
