<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updatePassword(User $user, string $password): bool
    {
        return $this->userRepository->updatePassword($user, $password);
    }

    public function registerUser(array $data): User
    {
        $user = $this->userRepository->createUser($data);

        event(new Registered($user));

        Auth::login($user);

        return $user;
    }

    public function getUserByEmail(string $email): User
    {
        return $this->userRepository->getUserByEmail($email);
    }
}