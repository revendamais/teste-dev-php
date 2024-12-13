<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;
    protected $fillable = [
        'nome',
        'empresa',
        'cnpjcpf',
        'telefone',
        'email',
        'endereco',
    ];

    // Filtro para ordenação (orderBy)
    public function scopeOrderByParam(Builder $query, string $field = 'id', string $direction = 'desc'): Builder
    {
        return $query->orderBy($field, strtolower($direction) === 'asc' ? 'asc' : 'desc');
    }
}
