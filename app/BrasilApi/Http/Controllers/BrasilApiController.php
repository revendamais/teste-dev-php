<?php

declare(strict_types=1);

namespace App\BrasilApi\Http\Controllers;

use App\Base\Helpers\Helper;
use App\Base\Http\Controllers\Controller;
use App\BrasilApi\Services\BrasilApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrasilApiController extends Controller
{
    public function __construct(
        private BrasilApiService $brasilApiService,
        private Helper           $helper
    )
    {
    }

    public function searchCnpj(string $cnpj): JsonResponse
    {
        try {
            $validatedCnpj = $this->helper->validateDocument($cnpj);

            if (!$validatedCnpj) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'CNPJ inválido.',
                ], 400);
            }

            $cnpjData = $this->brasilApiService->getCnpjSupplier($validatedCnpj);

            if (!$cnpjData) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'CNPJ não encontrado na API.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'CNPJ localizado com sucesso.',
                'data' => $cnpjData,
            ], 200);
        } catch (\Throwable $exception) {
            Log::error('Erro ao procurar CNPJ: ' . $exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao procurar CNPJ. Tente novamente mais tarde.',
            ], 500);
        }
    }

}