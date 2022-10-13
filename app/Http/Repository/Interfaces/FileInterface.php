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

    /**
     * @param File $file
     * @param string $publicLink
     * @return void
     */
    public function setPublicLink(File $file, string $publicLink): void;
}
