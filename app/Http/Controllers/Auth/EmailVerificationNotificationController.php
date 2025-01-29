<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\EmailServiceInterface;

class EmailVerificationNotificationController extends Controller
{
    protected $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($this->emailService->hasVerifiedEmail($user)) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $this->emailService->sendEmailVerificationNotification($user);

        return back()->with('status', 'verification-link-sent');
    }
}