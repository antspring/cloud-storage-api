<?php

namespace App\Http\Repository;

use App\Models\Folder;

class FolderRepository implements Interfaces\FolderInterface
{
    /**
     * Create Folder

     * @param array $folderData
     * @return void
     */
    public function create(array $folderData): void
    {
        Folder::create($folderData);
    }

    public function findByName(string $name)
    {
        return Folder::query()->where('name', $name)->first();
    }
}
