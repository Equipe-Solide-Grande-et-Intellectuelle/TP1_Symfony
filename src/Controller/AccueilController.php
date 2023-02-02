<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use App\Repository\SecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accueil')]
class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('accueil/accueil.html.twig', [
        ]);
    }
}
