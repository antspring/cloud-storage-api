<?php

namespace App\Http\Repository;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserRepository implements Contracts\UserContract
{
    public function create(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);

        return User::query()->create($userData);
    }

    public function find(array $userData)
    {
        $user = User::query()->where('email', $userData['email'])->first();

        if (Hash::check($userData['password'], $user->password)){
            return $user;
        }

        throw new HttpException(422, 'Wrong password');
    }
}
