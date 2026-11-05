<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class GateLockoutService
{
    /**
     * Batas maksimal kesalahan kunci gerbang sebelum diblokir permanen.
     */
    public const MAX_ATTEMPTS = 3;

    protected static function getBlockedFilePath(): string
    {
        return storage_path('app/gate_blocked_ips.json');
    }

    protected static function getAttemptsFilePath(): string
    {
        return storage_path('app/gate_attempts.json');
    }

    /**
     * Periksa apakah alamat IP sudah diblokir permanen.
     */
    public static function isBlocked(string $ip): bool
    {
        $file = self::getBlockedFilePath();
        if (!File::exists($file)) {
            return false;
        }

        $blocked = json_decode(File::get($file), true) ?: [];
        return isset($blocked[$ip]);
    }

    /**
     * Dapatkan detail pemblokiran IP.
     */
    public static function getBlockDetails(string $ip): ?array
    {
        $file = self::getBlockedFilePath();
        if (!File::exists($file)) {
            return null;
        }

        $blocked = json_decode(File::get($file), true) ?: [];
        return $blocked[$ip] ?? null;
    }

    /**
     * Dapatkan jumlah kegagalan saat ini untuk IP.
     */
    public static function getFailedAttempts(string $ip): int
    {
        $file = self::getAttemptsFilePath();
        if (!File::exists($file)) {
            return 0;
        }

        $attempts = json_decode(File::get($file), true) ?: [];
        return (int) ($attempts[$ip] ?? 0);
    }

    /**
     * Catat percobaan gagal dan blokir permanen jika mencapai batas 3 kali.
     */
    public static function recordFailedAttempt(string $ip, ?string $userAgent = null): int
    {
        $file = self::getAttemptsFilePath();
        $attempts = File::exists($file) ? (json_decode(File::get($file), true) ?: []) : [];

        $current = (int) ($attempts[$ip] ?? 0);
        $newCount = $current + 1;
        $attempts[$ip] = $newCount;

        File::put($file, json_encode($attempts, JSON_PRETTY_PRINT));

        if ($newCount >= self::MAX_ATTEMPTS) {
            self::blockIp($ip, $userAgent);
        }

        return $newCount;
    }

    /**
     * Blokir permanen alamat IP.
     */
    public static function blockIp(string $ip, ?string $userAgent = null): void
    {
        $file = self::getBlockedFilePath();
        $blocked = File::exists($file) ? (json_decode(File::get($file), true) ?: []) : [];

        $blocked[$ip] = [
            'ip' => $ip,
            'blocked_at' => now()->format('d M Y - H:i:s T'),
            'user_agent' => $userAgent ?? (request()->userAgent() ?? 'Unknown User-Agent'),
            'reason' => 'Mencapai batas 3 kali kesalahan kunci gerbang keamanan',
        ];

        File::put($file, json_encode($blocked, JSON_PRETTY_PRINT));
    }

    /**
     * Reset counter kesalahan IP (misal saat sukses masuk).
     */
    public static function resetAttempts(string $ip): void
    {
        $file = self::getAttemptsFilePath();
        if (!File::exists($file)) {
            return;
        }

        $attempts = json_decode(File::get($file), true) ?: [];
        if (isset($attempts[$ip])) {
            unset($attempts[$ip]);
            File::put($file, json_encode($attempts, JSON_PRETTY_PRINT));
        }
    }

    /**
     * Buka pemblokiran IP (spesifik atau seluruhnya).
     */
    public static function unblock(?string $ip = null): void
    {
        $blockedFile = self::getBlockedFilePath();
        $attemptsFile = self::getAttemptsFilePath();

        if ($ip) {
            if (File::exists($blockedFile)) {
                $blocked = json_decode(File::get($blockedFile), true) ?: [];
                unset($blocked[$ip]);
                File::put($blockedFile, json_encode($blocked, JSON_PRETTY_PRINT));
            }
            if (File::exists($attemptsFile)) {
                $attempts = json_decode(File::get($attemptsFile), true) ?: [];
                unset($attempts[$ip]);
                File::put($attemptsFile, json_encode($attempts, JSON_PRETTY_PRINT));
            }
        } else {
            File::put($blockedFile, json_encode([], JSON_PRETTY_PRINT));
            File::put($attemptsFile, json_encode([], JSON_PRETTY_PRINT));
        }
    }
}

