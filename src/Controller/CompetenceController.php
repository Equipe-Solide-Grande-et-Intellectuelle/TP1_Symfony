<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/competence')]
class CompetenceController extends AbstractController
{
    #[Route('/', name: 'app_competence_index', methods: ['GET'])]
    public function index(CompetencesRepository $competencesRepository): Response
    {
        return $this->render('competence/index.html.twig', [
            'competences' => $competencesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_competence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompetencesRepository $competencesRepository): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competencesRepository->save($competence, true);

            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_show', methods: ['GET'])]
    public function show(Competence $competence): Response
    {
        return $this->render('competence/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competence $competence, CompetencesRepository $competencesRepository): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competencesRepository->save($competence, true);

            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_delete', methods: ['POST'])]
    public function delete(Request $request, Competence $competence, CompetencesRepository $competencesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $competencesRepository->remove($competence, true);
        }

        return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
    }
}
