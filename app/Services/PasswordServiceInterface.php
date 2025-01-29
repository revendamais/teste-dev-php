<?php

namespace App\Services;

use Illuminate\Http\Request;

interface PasswordServiceInterface
{
    public function confirmPassword(string $password): void;
    public function resetPassword(array $data): bool;
    public function sendResetLink(array $data): string;
}