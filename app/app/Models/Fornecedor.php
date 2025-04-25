<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedor extends Model
{
    use HasFactory;

    /**
     * Table attributes
     *
     * @var array<int, string>
     */

     protected $table = 'fornecedor';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'documento',
    ];

}
