<?php

namespace App\Services\Jobs;

use App\Mail\Auth\VerificationCodeMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SendVerificationCodeEmailService
{
    /**
     * The prefix of the cache key
     */
    private const PREFIX = "verificationCode_";

    /**
     * Store the user instance to be authenticated
     *
     * @var mixed
     */
    private $user;

    /**
     * Create a new service instance.
     *
     * @param mixed $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Send the verification code to the registration user's email.
     *
     * @return void
     */
    public function sendEmail()
    {
        Mail::to($this->user->email)
            ->send(new VerificationCodeMail($this->user, $this->getCacheVerificationCode()));
    }

    /**
     * Store the verification code to cache.
     *
     * @return void
     */
    public function cacheVerificationCode()
    {
        $code      = randomNumberCode(1, 9999, 4, 0);
        $expiredAt = now()->addMinutes(3);

        Cache::put($this->getKey(), ['code' => $code], $expiredAt);
    }

    /**
     * Get the verification code from cache
     *
     * @return string
     */
    protected function getCacheVerificationCode()
    {
        $code = Cache::get($this->getKey());
        return $code['code'];
    }


    /**
     * Get the key.
     *
     * @return string
     */
    protected function getKey()
    {
        return self::PREFIX . $this->user->id;
    }
}