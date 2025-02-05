<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CnpjController extends Controller
{
    public function buscarCnpj(Request $request)
    {
        $cnpj = $request->input('cnpj');

        // Remove caracteres não numéricos do CNPJ
        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (!$this->validarCnpj($cnpj)) {
            return response()->json(['error' => 'CNPJ inválido'], 400);
        }

        // URL da API
        $url = "https://brasilapi.com.br/api/cnpj/v1/{$cnpj}";

        try {
            $client = new Client();
            $response = $client->request('GET', $url, [
                'verify' => false,  // ⚠️ Desativa a verificação SSL (não recomendado em produção)
                'timeout' => 5, // Timeout para evitar travamentos
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Verifica se há erro na resposta
            if (isset($data['error'])) {
                return response()->json(['error' => 'CNPJ não encontrado'], 404);
            }

            return response()->json($data);
        } catch (RequestException $e) {
            // Captura erros de requisição
            return response()->json([
                'error' => 'Erro ao consultar CNPJ',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function validarCnpj($cnpj)
    {
        return preg_match('/^\d{14}$/', $cnpj);
    }
}
