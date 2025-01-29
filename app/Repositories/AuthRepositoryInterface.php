<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function authenticate(array $credentials): bool;
    public function logout(): void;
}