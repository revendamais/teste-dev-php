<?php

namespace App\Repositories;

use App\Models\User;

class EmailRepository implements EmailRepositoryInterface
{
    public function hasVerifiedEmail(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    public function sendEmailVerificationNotification(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}