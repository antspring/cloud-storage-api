<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{

    public function __construct(private AuthService $service){}

    /**
     * Registration action

     * @param RegisterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $validate = $request->validated();

        $this->service->register($validate);

        return response(['message' => 'User registered']);
    }

    /**
     * Log in action

     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $this->service->login($validated);

        return response(['message' => 'User logged in']);
    }

    /**
     * Log out action

     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        $this->service->logout();

        return response(['message' => 'User logged out']);
    }
}
