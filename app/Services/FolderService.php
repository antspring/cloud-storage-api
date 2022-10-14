<?php

namespace App\Services;

use App\Http\Repository\Interfaces\FolderInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderService
{
    public function __construct(private FolderInterface $repository){}

    /**
     * Create Model folder and make directory
     *
     * @param string $path
     * @param int $userId
     * @return void
     */
    public function create(string $path, int $userId): void
    {
        $folderData = [
            'name' => $path,
            'user_id' => $userId
        ];

        $this->repository->create($folderData);

        Storage::makeDirectory($path);
    }

    /**
     * Find folder and count size files

     * @param Request $request
     * @return int
     */
    public function scan(Request $request): int
    {
        $folder = $this->repository->findByName($request->folder_name);

        $size = 0;

        $folder->files->each(function ($item) use (&$size){
            $size += $item->size;
        });

        return $size;
    }

    /**
     * Compose folder name

     * @param string $folderName
     * @param string $userName
     * @return string
     */
    public static function configurationFolderName(string $folderName, string $userName): string
    {
        return $userName . '/' . $folderName;
    }
}
