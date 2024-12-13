<?php

namespace App\DTO\Suppliers;

use App\Http\Requests\SupplierUpdateRequest;

class UpdateDTO
{
    public function __construct(
        public string $nome,
        public string $empresa,
        public string $cnpjcpf,
        public string $telefone,
        public string $email,
        public string $endereco,
    )
    {}

    public static function makeFromRequest(SupplierUpdateRequest $request): self
    {
        return new self(
            $request->nome,
            $request->empresa,
            $request->cnpjcpf,
            $request->telefone,
            $request->email,
            $request->endereco,
        );
    }
}
