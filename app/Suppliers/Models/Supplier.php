<?php

declare(strict_types=1);

namespace App\Suppliers\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'company_name',
        'document_type',
        'document_number',
        'email',
        'telephone',
        'address',
    ];
}
