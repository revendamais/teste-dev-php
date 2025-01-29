<?php

namespace App\Services;

use App\Repositories\PasswordRepositoryInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordService implements PasswordServiceInterface
{
    protected $passwordRepository;

    public function __construct(PasswordRepositoryInterface $passwordRepository)
    {
        $this->passwordRepository = $passwordRepository;
    }

    public function confirmPassword(string $password): void
    {
        $result = $this->passwordRepository->confirmPassword($password);

        if (! $result) {
            throw ValidationException::withMessages([
                'password' => __('The provided password does not match our records.'),
            ]);
        }

        session()->put('auth.password_confirmed_at', time());
    }

    public function resetPassword(array $data): bool
    {
        return $this->passwordRepository->resetPassword($data);
    }

    public function sendResetLink(array $data): string
    {
        return Password::sendResetLink($data);
    }
}