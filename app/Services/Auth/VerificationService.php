<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\VerificationRequest;
use App\Jobs\Auth\SendVerificationCodeEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class VerificationService
{
    /**
     * The prefix of the cache key
     */
    private const PREFIX = "verificationCode_";

    /**
     * Verify the verification code from request.
     *
     * @param VerificationRequest $request
     * @return void
     */
    public function verify(VerificationRequest $request)
    {
        $key = self::PREFIX . $request->user()->id;
        $code = Cache::get($key);
        if (! $code) {
            abort(403, "驗證碼已經失效！");
        }

        if(! hash_equals($code['code'], $request->verification_code)) {
            throw ValidationException::withMessages([
                'verification_code' => ['您輸入的驗證碼有誤！']
            ]);
        }

        Cache::forget($key);
    }

    /**
     * Resend the verification code to email.
     *
     * @param Request $request
     * @return void
     */
    public function resend(Request $request)
    {
        $key  = self::PREFIX . $request->user()->id;

        Cache::forget($key);

        SendVerificationCodeEmailJob::dispatch($request->user());
    }
}