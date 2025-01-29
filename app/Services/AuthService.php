<?php

namespace App\Services;

use App\Repositories\AuthRepositoryInterface;

class AuthService implements AuthServiceInterface
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function authenticate(array $credentials): bool
    {
        if ($this->authRepository->authenticate($credentials)) {
            session()->regenerate();
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        $this->authRepository->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}