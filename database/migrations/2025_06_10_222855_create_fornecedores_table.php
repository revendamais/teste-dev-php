<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
public function up(): void
{
    Schema::create('fornecedores', function (Blueprint $table) {
        $table->id();
        $table->string('tipo_documento'); // CPF ou CNPJ
        $table->string('documento')->unique(); // CPF ou CNPJ
        $table->string('nome');
        $table->string('email')->nullable();
        $table->string('telefone')->nullable();
        $table->string('endereco')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}
