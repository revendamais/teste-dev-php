<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\EmailRepositoryInterface;

class EmailService implements EmailServiceInterface
{
    protected $emailRepository;

    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function hasVerifiedEmail(User $user): bool
    {
        return $this->emailRepository->hasVerifiedEmail($user);
    }

    public function sendEmailVerificationNotification(User $user): void
    {
        $this->emailRepository->sendEmailVerificationNotification($user);
    }
}