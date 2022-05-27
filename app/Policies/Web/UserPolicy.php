<?php

namespace App\Policies\Web;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id
            ? Response::allow()
            : Response::deny('權限不足');
    }
}
