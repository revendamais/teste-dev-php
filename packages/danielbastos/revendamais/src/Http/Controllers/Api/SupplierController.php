<?php

namespace danielbastos\revendamais\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use danielbastos\revendamais\Repositories\Interfaces\SupplierRepositoryInterface;
use danielbastos\revendamais\Rules\ValidateDocument;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    protected $supplierRepository;

    protected function validate(Request $request, $id = null) {
        $rules = [
            'document' => ['required', 'string', 'max:14', new ValidateDocument()],
            'email' => ['required', 'email'],
            'name' => 'required|string',
            'business_name' => 'string',
        ];

        $data = $request->all();

        if (!empty($id)) $rules['document'][] = Rule::unique('suppliers', 'document')->ignore($id);
        else $rules['document'][] = Rule::unique('suppliers', 'document');

        if (!empty($id)) $rules['email'][] = Rule::unique('suppliers', 'email')->ignore($id);
        else $rules['email'][] = Rule::unique('suppliers', 'email');

        return $request->validate($rules);
    }

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index(Request $request)
    {
        return response()->json($this->supplierRepository->find($request->query()));
    }

    public function show($id)
    {
        $model = $this->supplierRepository->get($id);
        return $model
            ? response()->json($model)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request);
        return response()->json($this->supplierRepository->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, $id);
        $model = $this->supplierRepository->update($id, $data);
        return $model
            ? response()->json($model)
            : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        return $this->supplierRepository->delete($id)
            ? response()->json(['message' => 'Deleted'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
