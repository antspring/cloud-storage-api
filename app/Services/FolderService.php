<?php

namespace App\Services;

use App\Http\Repository\Interfaces\FolderInterface;
use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
