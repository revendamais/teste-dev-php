<?php

declare(strict_types=1);

namespace App\Suppliers\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Suppliers\Interfaces\SuppliersRepositoryInterface;
use App\Suppliers\Models\Supplier;

class SuppliersRepository extends BaseRepository implements SuppliersRepositoryInterface
{
    protected string $_model = Supplier::class;
}