<?php

namespace App\Http\Repository\Interfaces;

interface FolderInterface
{
    public function create(array $folderData): void;
}
