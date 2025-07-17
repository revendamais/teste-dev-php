<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrasilApiService
{
    public function consultarCNPJ(string $cnpj)
    {
        $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/" . $cnpj);

        if (!$response->successful()) {
            return null;
        }

        $dados = $response->json();

        return $this->parseCnpjData($dados);
    }

    private function parseCnpjData(array $dados): array
    {
        return [
            'nome'              => $dados['razao_social'] ?? "",
            'email'             => $dados['email'] ?? "",
            'cnpj'              => $dados['cnpj'] ?? null,
            'cpf'               => $dados['cpf_representante_legal'] ?? "",
            'contato_nome'      => $dados['nome_fantasia'] ?? "",
            'contato_numero'    => $dados['ddd_telefone_1'] ?? "",
            'endereco_cep'      => preg_replace('/[^0-9]/', '', $dados['cep'] ?? ''),
            'endereco_rua'      => $dados['logradouro'] ?? "",
            'endereco_numero'   => (int)$dados['numero'] ?? "",
            'endereco_cidade'   => $dados['municipio'] ?? "",
            'endereco_estado'   => $dados['uf'] ?? "",
        ];
    }


}