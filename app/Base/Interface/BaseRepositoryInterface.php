<?php

declare(strict_types=1);

namespace App\Base\Interface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function save(MOdel $model): Model;

    public function findAll(): Collection;

    public function find(int $id): ?Model;

    public function delete(int $id): void;
    
    public function update(int $id, array $data): Model;
}