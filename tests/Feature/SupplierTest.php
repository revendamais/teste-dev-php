<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_index_displays_suppliers()
    {
        $supplier = Supplier::factory()->withAddress()->create();

        $response = $this->get(route('suppliers.index'));
        $response->assertStatus(200);

        $response->assertInertia(
            fn($page) => $page
                ->component('Suppliers/Index')
                ->has('suppliers', 1)
        );
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('suppliers.create'));
        $response->assertStatus(200);

        $response->assertInertia(
            fn($page) => $page
                ->component('Suppliers/Create')
        );
    }

    public function test_store_creates_supplier()
    {
        $supplierData = Supplier::factory()->make()->toArray();

        $response = $this->post(route('suppliers.store'), $supplierData);
        $response->assertRedirect();

        $this->assertDatabaseHas('suppliers', [
            'name' => $supplierData['name'],
            'registration_number' => $supplierData['registration_number'],
            'email' => $supplierData['email'],
            'phone' => $supplierData['phone'],
        ]);
    }

    public function test_edit_displays_supplier()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->get(route('suppliers.edit', $supplier->id));
        $response->assertStatus(200);

        $response->assertInertia(
            fn($page) => $page
                ->component('Suppliers/Edit')
                ->has(
                    'supplier',
                    fn($page) => $page
                        ->where('id', $supplier->id)
                        ->where('name', $supplier->name)
                        ->etc()
                )
        );
    }

    public function test_edit_returns_error_message_when_supplier_not_found()
    {
        $response = $this->get(route('suppliers.edit', 999));
        $response->assertStatus(200);

        $response->assertInertia(
            fn($page) => $page
                ->component('Suppliers/Edit')
                ->has('error')
        );
    }

    public function test_destroy_returns_error_when_supplier_not_found()
    {        
        $nonExistentSupplierId = 999;
        
        $response = $this->delete(route('suppliers.destroy', $nonExistentSupplierId));        
        $response->assertRedirect();

        $response->assertSessionHasErrors([
            'error' => 'Record not found.'
        ]);
    }
}
