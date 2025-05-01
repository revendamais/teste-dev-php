<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Supplier
 *
 * @property $id
 * @property $name
 * @property $type
 * @property $document
 * @property $email
 * @property $phone
 * @property $address
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $perPage = 20;
    protected $table = 'suppliers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'type', 'document', 'email', 'phone', 'address'];


}
