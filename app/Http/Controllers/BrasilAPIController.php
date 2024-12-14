<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use OpenApi\Annotations as OA;


class BrasilAPIController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"BrasilAPI"},
     *     path="/api/brasilapi/{cnpj}",
     *     summary="Get cnpj details",
     *     description="Get all cnpj details",
     *     @OA\Parameter(
     *          name="cnpj",
     *          in="path",
     *          description="CNPJ without special characters.",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="CNPJ details."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No CNPJ found."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred while retrieving the CNPJ details."
     *     )
     * )
     */
    public function index(int $cnpj): JsonResponse
    {
        $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/{$cnpj}");

        $data = json_decode($response->body(), true);

        return response()->json([
            "data" => $data
        ], $response->status());
    }
}
