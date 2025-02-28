<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaV3 implements ValidationRule
{

    public function __construct(private string $action) {}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('captcha.secret'),
            'response' => $value,
        ])->json();


        Log::info('reCAPTCHA v3 Response:', $response);

        if (!isset($response['success']) || !$response['success'] || $response['score'] < 0.5 || $response['action'] !== $this->action) {
            $fail('reCAPTCHA verification failed. Please try again.');
        }
    }
}
