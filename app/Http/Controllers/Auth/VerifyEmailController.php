<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Jika email sudah terverifikasi
        if ($request->user()->hasVerifiedEmail()) {
            // Arahkan ke dashboard sesuai peran dengan parameter query untuk verifikasi
            return redirect()->intended(RouteServiceProvider::redirectTo($request->user()) . '?verified=1');
        }
    
        // Tandai email sebagai terverifikasi
        if ($request->user()->markEmailAsVerified()) {
            // Trigger event verifikasi email
            event(new Verified($request->user()));
        }
    
        // Arahkan ke dashboard sesuai peran setelah verifikasi email
        return redirect()->intended(RouteServiceProvider::redirectTo($request->user()) . '?verified=1');
    }    
}
