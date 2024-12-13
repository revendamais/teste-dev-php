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
        'name',
        'company',
        'cnpjcpf',
        'phone',
        'email',
        'address',
    ];

    // ordination filter by "asc" and "desc" to fields
    public function scopeOrderByParam(Builder $query, string $field = 'id', string $direction = 'desc'): Builder
    {
        return $query->orderBy($field, strtolower($direction) === 'asc' ? 'asc' : 'desc');
    }

    // company filters
    public function scopeFilterByCompany(Builder $query, string $company = null): Builder
    {
        if ($company) {
            $query->where('company', 'like', "%{$company}%");
        }

        return $query;
    }

    // CNPJ/CPF filter
    public function scopeFilterByCnpjCpf(Builder $query, string $cnpjcpf = null): Builder
    {
        if ($cnpjcpf) {
            $query->where('cnpjcpf', 'like', "%{$cnpjcpf}%");
        }

        return $query;
    }

    // e-mail filter
    public function scopeFilterByEmail(Builder $query, string $email = null): Builder
    {
        if ($email) {
            $query->where('email', 'like', "%{$email}%");
        }

        return $query;
    }
}
