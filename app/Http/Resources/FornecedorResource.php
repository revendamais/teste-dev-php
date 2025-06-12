<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FornecedorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'tipo_documento' => $this->tipo_documento,
            'documento' => $this->documento,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'created_at' => $this->created_at,
        ];
    }
}
