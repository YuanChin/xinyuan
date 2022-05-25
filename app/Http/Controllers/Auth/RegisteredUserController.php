<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\Auth\RegisterUserService;

class RegisteredUserController extends Controller
{
    /**
     * Store an instance of the RegisterUserService class.
     * 
     * @var RegisterUserService
     */
    private $registerUserService;

    /**
     * Create a new RegisterUserController instance.
     * 
     * @param RegisterUserService $registerUserService
     */
    public function __construct(RegisterUserService $registerUserService)
    {
        $this->registerUserService = $registerUserService;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request)
    {
        $this->registerUserService->register($request);

        return redirect()->route('verification.notice');
    }
}
