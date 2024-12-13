<?php

namespace App\DTO\Suppliers;

use App\Http\Requests\SupplierStoreRequest;

class CreateDTO
{
    public function __construct(
        public string $name,
        public string $company,
        public string $cnpjcpf,
        public string $phone,
        public string $email,
        public string $address,
    )
    {}

    public static function makeFromRequest(SupplierStoreRequest $request): self
    {
        return new self(
            $request->name,
            $request->company,
            $request->cnpjcpf,
            $request->phone,
            $request->email,
            $request->address
        );
    }
}
