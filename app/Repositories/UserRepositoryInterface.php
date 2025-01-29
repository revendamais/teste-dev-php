<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function updatePassword(User $user, string $password): bool;
    public function createUser(array $data): User;
    public function getUserByEmail(string $email): User;
}