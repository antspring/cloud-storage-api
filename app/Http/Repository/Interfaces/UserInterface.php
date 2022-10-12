<?php

namespace App\Http\Repository\Interfaces;

interface UserInterface
{
    /**
     * @param array $userData
     * @return mixed
     */
    public function create(array $userData);

    /**
     * @param array $userData
     * @return mixed
     */
    public function find(array $userData);
}
