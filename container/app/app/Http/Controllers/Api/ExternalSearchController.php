<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Contracts\ExternalSearchServiceInterface;

class ExternalSearchController extends Controller
{
    protected $externalSearch;

    public function __construct(ExternalSearchServiceInterface $search)
    {
        $this->externalSearch = $search;
    }

    public function search(Request $request)
    {
        $data = $this->externalSearch->searchCNPJ($request->cnpj);

        return response()->json($data);
    }
}
