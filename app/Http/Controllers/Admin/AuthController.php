<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GateLockoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Kunci sandi default gerbang keamanan admin jika belum diatur di .env.
     */
    public const DEFAULT_GATE_KEY = '@MMAProd_2026!';

    /**
     * Tampilkan halaman formulir login admin (atau gerbang keamanan jika belum diverifikasi).
     */
    public function loginForm(Request $request)
    {
        $ip = $request->ip();

        // Jika IP diblokir permanen karena 3x salah sandi gerbang
        if (GateLockoutService::isBlocked($ip)) {
            $details = GateLockoutService::getBlockDetails($ip);
            return response()->view('admin.auth.blocked', [
                'ip' => $ip,
                'blockedAt' => $details['blocked_at'] ?? now()->format('d M Y - H:i:s T'),
            ], 403);
        }

        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Jika sesi belum lolos verifikasi kunci gerbang keamanan, arahkan ke gerbang sandi
        if (!$request->session()->get('admin_gate_unlocked', false)) {
            return view('admin.auth.gate');
        }

        return view('admin.auth.login');
    }

    /**
     * Verifikasi kunci akses gerbang keamanan sebelum membuka login.
     */
    public function verifyGate(Request $request)
    {
        $ip = $request->ip();

        // Tolak jika sudah dalam daftar blokir permanen
        if (GateLockoutService::isBlocked($ip)) {
            $details = GateLockoutService::getBlockDetails($ip);
            return response()->view('admin.auth.blocked', [
                'ip' => $ip,
                'blockedAt' => $details['blocked_at'] ?? now()->format('d M Y - H:i:s T'),
            ], 403);
        }

        $request->validate([
            'gate_key' => ['required', 'string'],
        ]);

        $configuredKey = (string) config('app.admin_gate_key', env('ADMIN_GATE_KEY', self::DEFAULT_GATE_KEY));

        if ($request->input('gate_key') === $configuredKey) {
            // Berhasil: Bersihkan counter kesalahan untuk IP ini
            GateLockoutService::resetAttempts($ip);
            $request->session()->put('admin_gate_unlocked', true);
            return redirect()->route('admin.login')->with('status', 'Akses gerbang keamanan valid. Silakan masuk menggunakan kredensial admin.');
        }

        // Gagal: Catat percobaan salah
        $attempts = GateLockoutService::recordFailedAttempt($ip, $request->userAgent());
        $max = GateLockoutService::MAX_ATTEMPTS;

        if ($attempts >= $max) {
            return response()->view('admin.auth.blocked', [
                'ip' => $ip,
                'blockedAt' => now()->format('d M Y - H:i:s T'),
            ], 403);
        }

        $remaining = $max - $attempts;
        return back()->withErrors([
            'gate_key' => "Kunci akses keamanan salah. Sisa kesempatan: {$remaining} dari {$max} kali sebelum akses diblokir permanen.",
        ]);
    }

    /**
     * Proses otentikasi kredensial login admin.
     */
    public function login(Request $request)
    {
        $ip = $request->ip();

        // Tolak jika IP diblokir permanen
        if (GateLockoutService::isBlocked($ip)) {
            $details = GateLockoutService::getBlockDetails($ip);
            return response()->view('admin.auth.blocked', [
                'ip' => $ip,
                'blockedAt' => $details['blocked_at'] ?? now()->format('d M Y - H:i:s T'),
            ], 403);
        }

        // Tolak percobaan login langsung jika belum melewati gerbang sandi
        if (!$request->session()->get('admin_gate_unlocked', false)) {
            return redirect()->route('admin.login')->withErrors([
                'gate_key' => 'Sesi gerbang keamanan belum terverifikasi. Masukkan kunci akses terlebih dahulu.',
            ]);
        }

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $request->session()->put('admin_gate_unlocked', true);
            return redirect()->intended(route('admin.dashboard'))->with('status', 'Selamat datang di Panel Admin MMA Production.');
        }

        return back()->withErrors([
            'email' => 'Alamat email atau kata sandi tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Keluar dari sesi login admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Anda telah berhasil keluar dari sesi admin.');
    }
}

