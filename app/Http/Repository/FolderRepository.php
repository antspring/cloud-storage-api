<?php

namespace App\Http\Repository;

use App\Models\Folder;

class FolderRepository implements Interfaces\FolderInterface
{
    public function create(array $folderData): void
    {
        Folder::query()->create($folderData);
    }
}
