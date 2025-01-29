<?php

namespace App\Http\Controllers;

use App\Services\SupplierServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierServiceInterface $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the suppliers.
     */
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $suppliers = $this->supplierService->getAllSuppliers($search);
        return Inertia::render('Suppliers/Index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create(): Response
    {
        return Inertia::render('Suppliers/Create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:suppliers',
            'email' => 'required|email|max:255|unique:suppliers',
            'phone' => 'required|string|max:20',
            'address.street' => 'string|max:255',
            'address.city' => 'string|max:255',
            'address.state' => 'string|max:255',
            'address.postal_code' => 'string|max:10',
            'address.country' => 'string|max:255',
        ]);

        $this->supplierService->createSupplier($data);
        return back();
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit($id): Response
    {
        try {            
            $supplier = $this->supplierService->getSupplierById($id);            
            return Inertia::render('Suppliers/Edit', ['supplier' => $supplier]);
        } catch (ModelNotFoundException $e) {
            return Inertia::render('Suppliers/Edit', [
                'error' => 'Record not found.'
            ]);
        }
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'registration_number' => 'sometimes|required|string|max:255|unique:suppliers,registration_number,' . $id,
            'email' => 'sometimes|required|email|max:255|unique:suppliers,email,' . $id,
            'phone' => 'sometimes|required|string|max:20',
            'address.street' => 'sometimes|string|max:255',
            'address.city' => 'sometimes|string|max:255',
            'address.state' => 'sometimes|string|max:255',
            'address.postal_code' => 'sometimes|string|max:10',
            'address.country' => 'sometimes|string|max:255',
        ]);

        $this->supplierService->updateSupplier($id, $data);
        return back();
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $this->supplierService->deleteSupplier($id);
            return back();
        } catch(ModelNotFoundException $e) {
            return back()->withErrors(['error' => 'Record not found.']);
        }
    }
}
