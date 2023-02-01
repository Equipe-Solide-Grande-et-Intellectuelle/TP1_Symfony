<?php

namespace App\Controller;

use App\Entity\Lyceen;
use App\Form\LyceenType;
use App\Repository\LyceenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lyceen')]
class LyceenController extends AbstractController
{
    #[Route('/', name: 'app_lyceen_index', methods: ['GET'])]
    public function index(LyceenRepository $lyceenRepository): Response
    {
        return $this->render('lyceen/index.html.twig', [
            'lyceens' => $lyceenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lyceen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LyceenRepository $lyceenRepository): Response
    {
        $lyceen = new Lyceen();
        $form = $this->createForm(LyceenType::class, $lyceen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceenRepository->save($lyceen, true);

            return $this->redirectToRoute('app_lyceen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lyceen/new.html.twig', [
            'lyceen' => $lyceen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lyceen_show', methods: ['GET'])]
    public function show(Lyceen $lyceen): Response
    {
        return $this->render('lyceen/show.html.twig', [
            'lyceen' => $lyceen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lyceen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lyceen $lyceen, LyceenRepository $lyceenRepository): Response
    {
        $form = $this->createForm(LyceenType::class, $lyceen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceenRepository->save($lyceen, true);

            return $this->redirectToRoute('app_lyceen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lyceen/edit.html.twig', [
            'lyceen' => $lyceen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lyceen_delete', methods: ['POST'])]
    public function delete(Request $request, Lyceen $lyceen, LyceenRepository $lyceenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lyceen->getId(), $request->request->get('_token'))) {
            $lyceenRepository->remove($lyceen, true);
        }

        return $this->redirectToRoute('app_lyceen_index', [], Response::HTTP_SEE_OTHER);
    }
}
