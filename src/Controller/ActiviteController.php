<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Form\ActiviteType;
use App\Repository\ActivitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/activite')]
class ActiviteController extends AbstractController
{
    #[Route('/', name: 'app_activite_index', methods: ['GET'])]
    public function index(ActivitesRepository $activitesRepository): Response
    {
        return $this->render('activite/index.html.twig', [
            'activites' => $activitesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActivitesRepository $activitesRepository): Response
    {
        $activite = new Activite();
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activitesRepository->save($activite, true);

            return $this->redirectToRoute('app_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activite/new.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activite_show', methods: ['GET'])]
    public function show(Activite $activite): Response
    {
        return $this->render('activite/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activite $activite, ActivitesRepository $activitesRepository): Response
    {
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activitesRepository->save($activite, true);

            return $this->redirectToRoute('app_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activite/edit.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activite_delete', methods: ['POST'])]
    public function delete(Request $request, Activite $activite, ActivitesRepository $activitesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $activitesRepository->remove($activite, true);
        }

        return $this->redirectToRoute('app_activite_index', [], Response::HTTP_SEE_OTHER);
    }
}
