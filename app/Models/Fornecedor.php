<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    use HasFactory;
    protected $fillable = [
         'nome',
        'contato_numero',
        'contato_nome',
        'endereco_cep',
        'endereco_rua',
        'endereco_numero',
        'endereco_cidade',
        'endereco_estado',
        'email',
        'cnpj',
        'cpf',
    ];
}
