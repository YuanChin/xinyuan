<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Store the user instance to be authenticated
     *
     * @var mixed
     */
    private $user;

    /**
     * Store the verification code
     *
     * @var string
     */
    public $code;

    /**
     * Create a new mail instance.
     *
     * @param mixed $user
     * @param string $code
     */
    public function __construct($user, string $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->markdown('auth.emails.verification-code-mail')
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
