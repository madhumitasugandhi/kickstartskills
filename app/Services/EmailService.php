<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\GeneralMail;
use Exception;

class EmailService
{
    /**
     * View-based Email (Registration ke liye jo hum use kar rahe hain)
     */
    public function sendHtmlEmail(string $to, string $subject, string $view, array $data = []): array
    {
        try {
            if (empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'error' => 'Invalid email address'];
            }

            Mail::to($to)->send(new GeneralMail($subject, $view, $data));
            Log::info("Email sent to {$to} with subject: {$subject}");

            return ['success' => true, 'message' => 'Email sent successfully'];
        } catch (Exception $e) {
            Log::error("EmailService Error: " . $e->getMessage());
            return ['success' => false, 'error' => 'Mail delivery failed: ' . $e->getMessage()];
        }
    }

    /**
     * Direct HTML/OTP Email (Forget Password ke liye - No Blade needed)
     */
    public function sendRawHtmlEmail(string $to, string $subject, string $htmlContent): array
    {
        try {
            if (empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'error' => 'Invalid email address'];
            }

            // Seedha HTML string bhej raha hai
            Mail::html($htmlContent, function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            });

            Log::info("Raw HTML Email sent to {$to}");
            return ['success' => true, 'message' => 'OTP Email sent successfully'];
        } catch (Exception $e) {
            Log::error("Raw Email Error: " . $e->getMessage());
            return ['success' => false, 'error' => 'Mail delivery failed'];
        }
    }
}
