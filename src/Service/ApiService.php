<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;

class ApiService
{
    private $httpClient;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $_ENV['OPENAI_API_KEY'] ?? $apiKey;
    }

    public function getOnizukaPunchline()
    {
        try {

            $response = $this->httpClient->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4o',
                    'messages' => [['role' => 'user', 'content' => "Sors moi des punchlines iconique du professeur Eikichi Onizuka directement sans me faire de résumer ne dis rien d'autres"]],
                    'max_tokens' => 300 
                ],
            ]);

            return $response->toArray();
        } catch (ClientExceptionInterface $e) {
            return ['error' => 'Erreur API OpenAI : ' . $e->getMessage()];
        }
    }
}
