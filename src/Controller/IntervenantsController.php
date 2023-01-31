<?php

namespace App\Controller;

use App\Entity\Intervenants;
use App\Form\IntervenantsType;
use App\Repository\IntervenantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/intervenants')]
class IntervenantsController extends AbstractController
{
    #[Route('/', name: 'app_intervenants_index', methods: ['GET'])]
    public function index(IntervenantsRepository $intervenantsRepository): Response
    {
        return $this->render('intervenants/index.html.twig', [
            'intervenants' => $intervenantsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_intervenants_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IntervenantsRepository $intervenantsRepository): Response
    {
        $intervenant = new Intervenants();
        $form = $this->createForm(IntervenantsType::class, $intervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intervenantsRepository->save($intervenant, true);

            return $this->redirectToRoute('app_intervenants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervenants/new.html.twig', [
            'intervenant' => $intervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intervenants_show', methods: ['GET'])]
    public function show(Intervenants $intervenant): Response
    {
        return $this->render('intervenants/show.html.twig', [
            'intervenant' => $intervenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_intervenants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Intervenants $intervenant, IntervenantsRepository $intervenantsRepository): Response
    {
        $form = $this->createForm(IntervenantsType::class, $intervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intervenantsRepository->save($intervenant, true);

            return $this->redirectToRoute('app_intervenants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervenants/edit.html.twig', [
            'intervenant' => $intervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intervenants_delete', methods: ['POST'])]
    public function delete(Request $request, Intervenants $intervenant, IntervenantsRepository $intervenantsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervenant->getId(), $request->request->get('_token'))) {
            $intervenantsRepository->remove($intervenant, true);
        }

        return $this->redirectToRoute('app_intervenants_index', [], Response::HTTP_SEE_OTHER);
    }
}
