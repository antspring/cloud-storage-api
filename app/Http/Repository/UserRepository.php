<?php

namespace App\Http\Repository;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserRepository implements Interfaces\UserInterface
{
    /**
     * Hash password and create User

     * @param array $userData
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_User_QB
     */
    public function create(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);

        return User::create($userData);
    }

    /**
     * Find User or throw Exception

     * @param array $userData
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_User_QB|object|null
     */
    public function find(array $userData)
    {
        $user = User::query()->where('email', $userData['email'])->first();

        if (Hash::check($userData['password'], $user->password)){
            return $user;
        }

        throw new HttpException(422, 'Wrong password');
    }
}
