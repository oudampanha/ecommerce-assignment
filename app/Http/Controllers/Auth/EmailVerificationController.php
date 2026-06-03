<?php
// app/Http/Controllers/Auth/EmailVerificationController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\EmailVerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
  /**
   * Show the email verification form
   */
  public function show(): View
  {
    return view('auth.verify-code');
  }

  /**
   * Verify the provided code
   */
  public function verify(Request $request): RedirectResponse
  {
    $request->validate([
      'verification_code' => 'required|string|size:6',
    ]);

    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
      return redirect()->intended('/dashboard');
    }

    // Check rate limiting
    $key = 'verify-code:' . $user->id;
    if (RateLimiter::tooManyAttempts($key, 5)) {
      throw ValidationException::withMessages([
        'verification_code' => 'Too many verification attempts. Please try again later.',
      ]);
    }

    RateLimiter::hit($key, 900); // 15 minutes

    if ($user->verifyCode($request->verification_code)) {
      RateLimiter::clear($key);
      return redirect()->intended('/dashboard')->with('success', 'Email verified successfully!');
    }

    throw ValidationException::withMessages([
      'verification_code' => $user->isVerificationCodeExpired()
        ? 'Verification code has expired. Please request a new one.'
        : 'Invalid verification code.',
    ]);
  }

  /**
   * Resend verification code
   */
  public function resend(Request $request): RedirectResponse
  {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
      return redirect()->intended('/dashboard');
    }

    // Check rate limiting for resends
    $key = 'resend-code:' . $user->id;
    if (RateLimiter::tooManyAttempts($key, 3)) {
      return back()->withErrors([
        'resend' => 'Too many resend requests. Please wait before requesting another code.',
      ]);
    }

    RateLimiter::hit($key, 300); // 5 minutes

    $code = $user->generateVerificationCode();
    $user->notify(new EmailVerificationCode($code));

    return back()->with('message', 'A new verification code has been sent to your email!');
  }
}
