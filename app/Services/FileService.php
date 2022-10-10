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

    /**
     * Save file

     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        $folder = $this->findFolder($request);

        $filePath = $request->file('file')->storeAs($folder->name, $request->file('file')->getClientOriginalName());

        $this->repository->create($this->configurationFileData(basename($filePath), $folder->id));
    }

    /**
     * Search folder and file

     * @param Request $request
     * @return string
     */
    public function download(Request $request): string
    {
        $folder = $this->findFolder($request);

        $file = $folder->findFile($request->file_name);

        $path = FolderService::configurationFolderName($file->name, $folder->name);

        return $path;
    }

    /**
     * Search folder

     * @param Request $request
     * @return Folder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_Folder_QB|object|null
     */
    public function findFolder(Request $request): \Illuminate\Database\Eloquent\Model|Folder|\Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\_IH_Folder_QB|null
    {
        if (!$request->folder_name){
            return Folder::query()->where('name', $request->user()->name)->first();
        } else {
            $request['folder_name'] = FolderService::configurationFolderName($request->folder_name, $request->user()->name);

            return Folder::query()->where('name', $request->folder_name)->firstOrFail();
        }
    }

    /**
     * Compose data for create model File

     * @param string $name
     * @param int $id
     * @return array
     */
    public function configurationFileData(string $name, int $id): array
    {
        return [
            'name' => $name,
            'folder_id' => $id
        ];
    }
}
