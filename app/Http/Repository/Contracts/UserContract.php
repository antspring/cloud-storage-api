<?php

namespace App\Http\Repository\Contracts;

interface UserContract
{
    public function create(array $userData);

    public function find(array $userData);
}
