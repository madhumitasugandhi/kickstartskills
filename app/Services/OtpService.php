<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class OtpService
{
    private $ttl = 300; // 5 min
    private $cooldown = 30; // resend control

    public function generateOtp(string $email): array
    {
        $otp = random_int(100000, 999999);
        $key = $this->getKey($email);
        $cooldownKey = $this->getCooldownKey($email);

        // cooldown check
        if (Cache::has($cooldownKey)) {
            return [
                'success' => false,
                'message' => 'Please wait before requesting again'
            ];
        }

        // store hashed OTP
        Cache::put($key, Hash::make($otp), now()->addSeconds($this->ttl));

        // cooldown
        Cache::put($cooldownKey, true, now()->addSeconds($this->cooldown));

        return [
            'success' => true,
            'otp' => $otp
        ];
    }

    public function verifyOtp(string $email, string $otp): bool
    {
        $key = $this->getKey($email);

        $storedOtp = Cache::get($key);

        if (!$storedOtp) return false;

        $valid = Hash::check($otp, $storedOtp);

        if ($valid) {
            Cache::forget($key);
        }

        return $valid;
    }

    private function getKey($email)
    {
        return "otp_{$email}";
    }

    private function getCooldownKey($email)
    {
        return "otp_cooldown_{$email}";
    }
}