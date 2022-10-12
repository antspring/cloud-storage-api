<?php

namespace App\Services;

use App\Http\Repository\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(private UserInterface $repository, private FolderService $folderService){}

    /**
     * Registration user

     * @param array $userData
     * @return void
     */
    public function register(array $userData): void
    {
        $user = $this->repository->create($userData);

        $this->folderService->create($user->name, $user->id);

        Auth::login($user);
    }

    /**
     * Log in user

     * @param array $userData
     * @return void
     */
    public function login(array $userData): void
    {
        $user = $this->repository->find($userData);

        Auth::login($user);
    }

    /**
     * Log out user

     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
