<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}