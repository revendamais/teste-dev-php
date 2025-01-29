<?php

namespace App\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function updatePassword(User $user, string $password): bool;
    public function registerUser(array $data): User;
    public function getUserByEmail(string $email): User;
}