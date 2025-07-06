<?php
namespace danielbastos\revendamais\database\seeders;

use Illuminate\Database\Seeder;
use danielbastos\revendamais\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'document' => '96112899280',
            'name' => 'Débora Renata Clarice Assis',
            'email' => 'debora_renata_assis@graficajardim.com.br'
        ]);

        Supplier::create([
            'document' => '67260128887',
            'name' => 'Felipe César Juan Moraes',
            'email' => 'felipecesarmoraes@ambev.com.br'
        ]);

        Supplier::create([
            'document' => '05373231479',
            'name' => 'Márcia Nair Cecília Gonçalves',
            'email' => 'marcia_goncalves@facilitycom.com.br'
        ]);

        Supplier::create([
            'document' => '57129038000186',
            'name' => 'Emily e Tereza Vidros ME',
            'business_name' => 'Emily e Tereza Vidros',
            'email' => 'representantes@emilyeterezavidrosme.com.br'
        ]);

        Supplier::create([
            'document' => '74781482000109',
            'name' => 'Otávio e Cauã Pizzaria Delivery ME',
            'business_name' => 'Otávio e Cauã Pizzaria',
            'email' => 'dtesouraria@otavioecauapizzariadeliveryme.com.br'
        ]);

        Supplier::create([
            'document' => '74386567000184',
            'name' => 'Tânia e Kauê Entulhos Ltda',
            'business_name' => 'Tânia e Kauê Entulhos',
            'email' => 'posvenda@taniaekaueentulhosltda.com.br'
        ]);
    }
}