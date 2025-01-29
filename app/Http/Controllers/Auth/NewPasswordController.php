<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\PasswordServiceInterface;

class NewPasswordController extends Controller
{
    protected $passwordService;

    public function __construct(PasswordServiceInterface $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * Display the password reset view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $result = $this->passwordService->resetPassword($request->only('email', 'password'));

        if ($result) {
            return redirect()->route('login')->with('status', 'Password reset successfully.');
        }

        return back()->withErrors(['email' => 'Failed to reset password.']);
    }
}
