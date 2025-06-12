<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedor extends Model
{
     use HasFactory; // <- Este uso do trait é essencial!
     
    protected $table = 'fornecedores';

    protected $fillable = [
        'tipo_documento',
        'documento',
        'nome',
        'contato',
        'email',
        'endereco',
    ];
}
