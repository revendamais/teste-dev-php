<?php

namespace App\Services;

use App\Models\User;

interface EmailServiceInterface
{
    public function hasVerifiedEmail(User $user): bool;
    public function sendEmailVerificationNotification(User $user): void;
}