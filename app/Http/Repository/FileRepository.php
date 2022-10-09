<?php

namespace App\Http\Repository;

use App\Models\File;

class FileRepository implements Interfaces\FileInterface
{
    public function create(array $data): void
    {
        File::create($data);
    }
}
