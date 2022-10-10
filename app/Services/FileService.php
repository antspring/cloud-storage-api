<?php

namespace App\Services;

use App\Http\Repository\Interfaces\FileInterface;
use App\Models\File;
use App\Models\Folder;
use App\Services\Traits\FileServiceHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FileService
{
    use FileServiceHelpers;

    public function __construct(private FileInterface $repository){}

    /**
     * Save file

     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        $folder = $this->findFolder($request);

        $this->checkForUnique($folder, $request->file('file')->getClientOriginalName());

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

        return Storage::disk('local')->path($path);
    }

    /**
     * Delete file

     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        $folder = $this->findFolder($request);

        $file = $folder->findFile($request->file_name);

        $path = FolderService::configurationFolderName($file->name, $folder->name);

        Storage::disk('local')->delete($path);

        $this->repository->delete($file);
    }

    /**
     * Rename file

     * @param Request $request
     * @return void
     */
    public function rename(Request $request): void
    {
        $folder = $this->findFolder($request);

        $file = $folder->findFile($request->file_name);

        $path = FolderService::configurationFolderName($file->name, $folder->name);

        Storage::move($path, $folder->name . '/' . $request->new_file_name);

        $this->repository->update($file, $request->new_file_name);
    }
}
