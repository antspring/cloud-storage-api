<?php

namespace App\Services;

use App\Http\Repository\Interfaces\FileInterface;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class FileService
{
    public function __construct(private FileInterface $repository){}

    public function create(Request $request): void
    {
        $folder = $this->findFolder($request);

        $request->file('file')->store($folder->name);

        $this->repository->create($this->configurationFileData($request->file('file'), $folder->id));
    }

    public function findFolder(Request $request)
    {
        if (!$request->folder_name){
            return Folder::query()->where('name', $request->user()->name)->first();
        } else {
            $request['folder_name'] = FolderService::configurationFolderName($request->folder_name, $request->user()->name);

            return Folder::query()->where('name', $request->folder_name)->firstOrFail();
        }
    }

    public function configurationFileData(string $name, int $id): array
    {
        return [
            'name' => $name,
            'folder_id' => $id
        ];
    }
}
