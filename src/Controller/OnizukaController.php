<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/onizuka')]
class OnizukaController extends AbstractController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    #[Route('/punchline', name: 'onizuka_punchline', methods: ['POST'])]
    public function getOnizukaPunchline(): Response
    {
        $response = $this->apiService->getOnizukaPunchline();
        return $this->json($response);
    }
}
