<?php

namespace App\DTO\Suppliers;

use App\Http\Requests\SupplierUpdateRequest;

class UpdateDTO
{
    public function __construct(
        public string $company,
        public string $cnpjcpf,
        public string $phone,
        public string $email,
        public string $address,
    )
    {}

    public static function makeFromRequest(SupplierUpdateRequest $request): self
    {
        return new self(
            $request->company,
            $request->cnpjcpf,
            $request->phone,
            $request->email,
            $request->address,
        );
    }
}
