<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
    /**
     * Handle an incoming registration request.
     *
     * @param RegisterUserRequest $request
     * @return void
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->create($request->only([
            'name',
            'email',
            'password'
        ]));

        Auth::login($user);
    }

    /**
     * Create a new user
     *
     * @param array $data
     * @return \App\Models\User
     */
    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}