<?php

namespace App\Jobs\Auth;

use App\Services\Jobs\SendVerificationCodeEmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVerificationCodeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Store an instance of the SendVerificationCodeEmailService class.
     *
     * @var SendVerificationCodeEmailService
     */
    private $sendVerificationCodeEmailService;


    /**
     * Create a new job instance.
     *
     * @param mixed $user
     * @return void
     */
    public function __construct($user)
    {
        $this->sendVerificationCodeEmailService = new SendVerificationCodeEmailService($user);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendVerificationCodeEmailService->cacheVerificationCode();
        $this->sendVerificationCodeEmailService->sendEmail();
    }
}
