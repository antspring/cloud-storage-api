<?php

namespace App\Http\Repository\Interfaces;

interface UserInterface
{
    public function create(array $userData);

    public function find(array $userData);
}
