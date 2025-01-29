<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordRepository implements PasswordRepositoryInterface
{
    public function confirmPassword(string $password): bool
    {
        return Hash::check($password, Auth::user()->password);
    }

    public function resetPassword(array $data): bool
    {
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            $user->password = bcrypt($data['password']);
            $user->save();
            return true;
        }

        return false;
    }
}