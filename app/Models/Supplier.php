<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'email',
        'phone',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}