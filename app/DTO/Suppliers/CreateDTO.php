<?php

namespace App\DTO\Suppliers;

use App\Http\Requests\SupplierStoreRequest;

class CreateDTO
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

    public static function makeFromRequest(SupplierStoreRequest $request): self
    {
        return new self(
            $request->nome,
            $request->empresa,
            $request->cnpjcpf,
            $request->telefone,
            $request->email,
            $request->endereco
        );
    }
}
