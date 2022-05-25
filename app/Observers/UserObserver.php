<?php

namespace App\Observers;

use App\Jobs\Auth\SendVerificationCodeEmailJob;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        // 發送驗證碼
        SendVerificationCodeEmailJob::dispatch($user);
    }
}
