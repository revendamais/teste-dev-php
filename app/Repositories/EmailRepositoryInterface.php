<?php

namespace App\Repositories;

use App\Models\User;

interface EmailRepositoryInterface
{
    public function hasVerifiedEmail(User $user): bool;
    public function sendEmailVerificationNotification(User $user): void;
}