<?php

namespace App\Http\Repository\Interfaces;

use App\Models\File;

interface FileInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void;

    /**
     * @param File $file
     * @return void
     */
    public function delete(File $file): void;
}
