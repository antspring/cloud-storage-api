<?php

namespace App\Http\Repository\Interfaces;

interface FileInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void;
}
