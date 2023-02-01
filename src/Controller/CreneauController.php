<?php

namespace App\Controller;

use App\Entity\Creneau;
use App\Form\CreneauType;
use App\Repository\CreneauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/creneau')]
class CreneauController extends AbstractController
{
    #[Route('/', name: 'app_creneau_index', methods: ['GET'])]
    public function index(CreneauRepository $creneauRepository): Response
    {
        return $this->render('creneau/index.html.twig', [
            'creneaus' => $creneauRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_creneau_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CreneauRepository $creneauRepository): Response
    {
        $creneau = new Creneau();
        $form = $this->createForm(CreneauType::class, $creneau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creneauRepository->save($creneau, true);

            return $this->redirectToRoute('app_creneau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('creneau/new.html.twig', [
            'creneau' => $creneau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_creneau_show', methods: ['GET'])]
    public function show(Creneau $creneau): Response
    {
        return $this->render('creneau/show.html.twig', [
            'creneau' => $creneau,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_creneau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Creneau $creneau, CreneauRepository $creneauRepository): Response
    {
        $form = $this->createForm(CreneauType::class, $creneau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creneauRepository->save($creneau, true);

            return $this->redirectToRoute('app_creneau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('creneau/edit.html.twig', [
            'creneau' => $creneau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_creneau_delete', methods: ['POST'])]
    public function delete(Request $request, Creneau $creneau, CreneauRepository $creneauRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creneau->getId(), $request->request->get('_token'))) {
            $creneauRepository->remove($creneau, true);
        }

        return $this->redirectToRoute('app_creneau_index', [], Response::HTTP_SEE_OTHER);
    }
}
