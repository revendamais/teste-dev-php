<?php

namespace danielbastos\revendamais\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use danielbastos\revendamais\Rules\ValidateDocument;

class CnpjController extends Controller
{
    public function lookup(Request $request, string $cnpj)
    {
        $value = preg_replace('/\D/', '', $cnpj);
        $validator = Validator::make(['cnpj' => $value], [
            'cnpj' => ['required', 'string', 'size:14', new ValidateDocument()],
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $cacheKey = __METHOD__.'::'.$value;

        $cached = Cache::get($cacheKey);
        if ($cached) return response()->json($cached);

        $apiResponse = Http::get(config('revendamais.cpnj_api_url').$value);

        if ($apiResponse->successful()) {
            $data = $apiResponse->json();
            Cache::put($cacheKey, $data, now()->addMinute());
            return response()->json($data);
        }

        return response()->json([
            'error' => 'Não foi possível buscar o CNPJ. Verifique se é válido.'
        ], $response->status());
    }
}