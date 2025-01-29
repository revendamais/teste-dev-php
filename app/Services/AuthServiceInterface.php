<?php

namespace App\Services;

interface AuthServiceInterface
{
    public function authenticate(array $credentials): bool;
    public function logout(): void;
}