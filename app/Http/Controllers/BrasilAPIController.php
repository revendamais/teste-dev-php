<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;


class BrasilAPIController extends Controller
{
    public function index(int $cnpj): JsonResponse
    {
        $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/54343940000102");

        $data = json_decode($response->body(), true);

        return response()->json([
            "data" => $data
        ], $response->status());
    }
}
