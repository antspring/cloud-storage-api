<?php

namespace App\Http\Repository\Interfaces;

interface FolderInterface
{
    /**
     * @param array $folderData
     * @return void
     */
    public function create(array $folderData): void;

    public function findByName(string $name);
}
