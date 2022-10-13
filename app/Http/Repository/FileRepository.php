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

    /**
     * Update File name

     * @param File $file
     * @param string $name
     * @return void
     */
    public function updateFileName(File $file, string $name): void
    {
        $file->update(['name' => $name]);
    }

    /**
     * Set public link

     * @param File $file
     * @param string $publicLink
     * @return void
     */
    public function setPublicLink(File $file, string $publicLink): void
    {
        $file->update(['public_link' => $publicLink]);
    }
}
