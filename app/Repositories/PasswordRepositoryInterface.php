<?php

namespace App\Repositories;

interface PasswordRepositoryInterface
{
    public function confirmPassword(string $password): bool;
    public function resetPassword(array $data): bool;
}