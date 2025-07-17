<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('contato_numero')->nullable();
            $table->string('contato_nome')->nullable();
            $table->string('endereco_cep')->nullable();
            $table->string('endereco_rua')->nullable();
            $table->integer('endereco_numero')->nullable();
            $table->string('endereco_cidade')->nullable();
            $table->string('endereco_estado')->nullable();
            $table->string('email')->nullable();
            $table->string('cnpj')->unique();
            $table->string('cpf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
