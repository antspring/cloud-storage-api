<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{

    public function __construct(private AuthService $service){}

    public function register(RegisterRequest $request)
    {
        $validate = $request->validated();

        $this->service->register($validate);

        return response(['message' => 'User registered']);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $this->service->login($validated);

        return response(['message' => 'User logged in']);
    }

    public function logout()
    {
        $this->service->logout();

        return response(['message' => 'User logged out']);
    }
}
