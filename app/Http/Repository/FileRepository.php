<?php

namespace App\Http\Repository;

use App\Models\File;

class FileRepository implements Interfaces\FileInterface
{
    /**
     * Create File

     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        File::create($data);
    }

    public function delete(File $file): void
    {
        $file->delete();
    }
}
