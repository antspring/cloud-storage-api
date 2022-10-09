<?php

namespace App\Http\Repository\Interfaces;

interface FileInterface
{
    public function create(array $data): void;
}
