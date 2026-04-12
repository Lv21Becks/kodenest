<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Mail\AdminTwoFactorCode;
use Illuminate\Support\Facades\Mail;

class AdminLoginController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function create()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($request->only('email', 'password'), $remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        $user = auth()->user();

        if (! $user->isAdmin()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'You do not have admin access.',
            ]);
        }

        // Development / Emergency 2FA Bypass (Direct ENV read to bypass PaaS config caching)
        $bypassSwitch = $_SERVER['ADMIN_2FA_ENABLED'] ?? $_ENV['ADMIN_2FA_ENABLED'] ?? env('ADMIN_2FA_ENABLED') ?? config('auth.admin_2fa_enabled', true);
        if (filter_var($bypassSwitch, FILTER_VALIDATE_BOOLEAN) === false) {
            session(['2fa_verified' => true]);
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        // Adaptive Authentication Check
        if ($trustToken = $request->cookie('admin_device_trust')) {
            $trustedDevice = \App\Models\AdminTrustedDevice::where('token', hash('sha256', $trustToken))
                ->where('user_id', $user->id)
                ->where('expires_at', '>', now())
                ->where('ip_address', $request->ip())
                ->where('user_agent', $request->userAgent())
                ->first();

            if ($trustedDevice) {
                // Device is trusted and IP + UA match! Bypass 2FA
                $trustedDevice->update(['last_used_at' => now()]);
                session(['2fa_verified' => true]);
                
                // Clear any lingering code
                $user->update([
                    'two_factor_code' => null,
                    'two_factor_expires_at' => null,
                ]);
                
                return redirect()->intended(route('admin.dashboard', absolute: false));
            }
        }

        // Generate 2FA OTP
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->update([
            'two_factor_code'       => $code,
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\AdminTwoFactorCode($code, $user));
        } catch (\Exception $e) {
            // If the mail server fails or credentials are bad, log the admin out and show an error so they aren't trapped on the 2FA screen
            \Illuminate\Support\Facades\Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->with('error', 'Unable to send 2FA email. Please check server email credentials.');
        }

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
