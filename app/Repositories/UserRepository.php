<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function updatePassword(User $user, string $password): bool
    {
        $user->password = Hash::make($password);
        return $user->save();
    }

    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getUserByEmail(string $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }
}