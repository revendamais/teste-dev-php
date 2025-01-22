<?php

declare(strict_types=1);

namespace App\BrasilApi\Services\API;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class BrasilApi implements BrasilApiInterface
{
    public function __construct(
        private ClientInterface $client,
    )
    {
    }

    public function getCnpj(string $cnpj): array
    {
        try {
            $uri = "https://brasilapi.com.br/api/cnpj/v1/{$cnpj}";

            $response = $this->client->get($uri);

            return $this->renderResponse($response);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        } catch (\Exception $exception) {

            return ['error' => $exception->getMessage()];
        }
    }

    private function renderResponse(Response $response): array
    {
        return match ($response->getStatusCode()) {
            200 => ['success' => json_decode($response->getBody()->getContents(), true)],
            404 => ['error' => json_decode($response->getBody()->getContents(), true)],
            default => ['error' =>
                $response->getReasonPhrase() . $response->getBody()->getContents()
            ],
        };
    }
}