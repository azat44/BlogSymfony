<?php

namespace App\Controller;

use App\Repository\LangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LangueController extends AbstractController
{
    #[Route('/langues', name: 'app_langues')]
    public function index(LangueRepository $langueRepository): Response
    {
        $langues = $langueRepository->findBy(['estActive' => true]);

        return $this->render('langues/index.html.twig', [
            'langues' => $langues,
        ]);
    }
}
