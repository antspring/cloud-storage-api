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

    /**
     * Delete File

     * @param File $file
     * @return void
     */
    public function delete(File $file): void
    {
        $file->delete();
    }
}
