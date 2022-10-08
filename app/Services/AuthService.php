<?php

namespace App\Services;

use App\Http\Repository\Contracts\UserContract;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(private UserContract $repository){}

    public function register(array $userData): void
    {
        $user = $this->repository->create($userData);

        Auth::login($user);
    }

    public function login(array $userData): void
    {
        $user = $this->repository->find($userData);

        Auth::login($user);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
