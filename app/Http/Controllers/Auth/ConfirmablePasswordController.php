<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\PasswordServiceInterface;

class ConfirmablePasswordController extends Controller
{
    protected $passwordService;

    public function __construct(PasswordServiceInterface $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * Show the confirm password view.
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required'],
        ]);
        
        $this->passwordService->confirmPassword($request->input('password'));        

        return redirect()->intended();
    }
}