<?php

namespace App\Controller;

use App\Entity\Lyceens;
use App\Form\LyceensType;
use App\Repository\LyceensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lyceens')]
class LyceensController extends AbstractController
{
    #[Route('/', name: 'app_lyceens_index', methods: ['GET'])]
    public function index(LyceensRepository $lyceensRepository): Response
    {
        return $this->render('lyceens/index.html.twig', [
            'lyceens' => $lyceensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lyceens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LyceensRepository $lyceensRepository): Response
    {
        $lyceen = new Lyceens();
        $form = $this->createForm(LyceensType::class, $lyceen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceensRepository->save($lyceen, true);

            return $this->redirectToRoute('app_lyceens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lyceens/new.html.twig', [
            'lyceen' => $lyceen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lyceens_show', methods: ['GET'])]
    public function show(Lyceens $lyceen): Response
    {
        return $this->render('lyceens/show.html.twig', [
            'lyceen' => $lyceen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lyceens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lyceens $lyceen, LyceensRepository $lyceensRepository): Response
    {
        $form = $this->createForm(LyceensType::class, $lyceen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceensRepository->save($lyceen, true);

            return $this->redirectToRoute('app_lyceens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lyceens/edit.html.twig', [
            'lyceen' => $lyceen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lyceens_delete', methods: ['POST'])]
    public function delete(Request $request, Lyceens $lyceen, LyceensRepository $lyceensRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lyceen->getId(), $request->request->get('_token'))) {
            $lyceensRepository->remove($lyceen, true);
        }

        return $this->redirectToRoute('app_lyceens_index', [], Response::HTTP_SEE_OTHER);
    }
}
