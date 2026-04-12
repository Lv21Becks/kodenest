<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('admin.auth.two-factor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|min:6',
        ]);

        $user = auth()->user();
        
        $backupCode = $_SERVER['ADMIN_2FA_BACKUP_CODE'] ?? $_ENV['ADMIN_2FA_BACKUP_CODE'] ?? env('ADMIN_2FA_BACKUP_CODE');

        if (($request->code === $user->two_factor_code && now()->lessThanOrEqualTo($user->two_factor_expires_at)) || 
            ($backupCode && $request->code === $backupCode)) {
            session(['2fa_verified' => true]);

            $user->update([
                'two_factor_code' => null,
                'two_factor_expires_at' => null,
            ]);

            $response = redirect()->intended(route('admin.dashboard', absolute: false));

            if ($request->boolean('trust_device')) {
                $token = \Illuminate\Support\Str::random(60);
                
                \App\Models\AdminTrustedDevice::create([
                    'user_id' => $user->id,
                    'token' => hash('sha256', $token),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'last_used_at' => now(),
                    'expires_at' => now()->addDays(30),
                ]);

                // 43200 minutes = 30 days
                \Illuminate\Support\Facades\Cookie::queue('admin_device_trust', $token, 43200);
            }

            return $response;
        }

        throw ValidationException::withMessages([
            'code' => __('The provided two-factor authentication code was invalid or has expired.'),
        ]);
    }

    public function resend(Request $request)
    {
        $user = auth()->user();
        
        // Prevent spam clicking (Wait 30 seconds between requests)
        if ($user->two_factor_expires_at && now()->diffInSeconds($user->two_factor_expires_at) > (10 * 60) - 30) {
            return back()->with('status', 'Please wait before requesting another code.');
        }

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'two_factor_code' => $code,
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\AdminTwoFactorCode($code, $user));
        } catch (\Exception $e) {
            return back()->withErrors(['code' => 'Failed to send email. Check server configuration or use a backup code.']);
        }

        return back()->with('status', 'A new two-factor code has been sent to your email.');
    }
}
