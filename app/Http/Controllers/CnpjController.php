<?php

namespace App\Http\Controllers;

use App\Services\CnpjServiceInterface;
use Illuminate\Http\JsonResponse;

class CnpjController extends Controller
{
    protected $cnpjService;

    public function __construct(CnpjServiceInterface $cnpjService)
    {
        $this->cnpjService = $cnpjService;
    }

    public function show($cnpj): JsonResponse
    {
        $response = $this->cnpjService->getCnpjData($cnpj);
        return response()->json($response['data'], $response['status_code']);
    }
}
