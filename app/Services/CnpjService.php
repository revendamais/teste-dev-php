<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

class CnpjService implements CnpjServiceInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://brasilapi.com.br/api/cnpj/v1/',
            'timeout'  => 5.0,
        ]);
    }

    public function getCnpjData(string $cnpj): array
    {
        // Define a chave de cache
        $cacheKey = 'cnpj_data_' . $cnpj;

        // Tenta obter os dados do cache
        $cachedData = Cache::get($cacheKey);

        if ($cachedData) {
            return [
                'status_code' => 200,
                'data' => $cachedData
            ];
        }

        try {
            $response = $this->client->request('GET', $cnpj);
            $data = json_decode($response->getBody(), true);

            // Armazena os dados no cache por 60 minutos
            Cache::put($cacheKey, $data, 60 * 60);

            return [
                'status_code' => $response->getStatusCode(),
                'data' => $data
            ];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return [
                    'status_code' => $e->getResponse()->getStatusCode(),
                    'data' => json_decode($e->getResponse()->getBody()->getContents(), true)
                ];
            }
            return [
                'status_code' => 500,
                'data' => ['error' => 'Unable to fetch data']
            ];
        }
    }
}