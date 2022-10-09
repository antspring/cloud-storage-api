<?php

namespace App\Services;

use App\Http\Repository\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(private UserInterface $repository, private FolderService $folderService){}

    public function register(array $userData): void
    {
        $user = $this->repository->create($userData);

        $this->folderService->create($user->name, $user->id);

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
