<?php

namespace danielbastos\revendamais\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {
    protected $table = 'suppliers';

    protected $fillable = [
        'document', 'email', 'name', 'business_name'
    ];

    public $timestamps = true;
}