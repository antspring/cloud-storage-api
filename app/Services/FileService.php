<?php

namespace App\Services;

use App\Http\Repository\Interfaces\FileInterface;
use App\Models\File;
use App\Models\Folder;
use App\Services\Traits\FileServiceHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FileService
{
    use FileServiceHelpers;

    public function __construct(private FileInterface $repository){}

    /**
     * Save file and check for max size

     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        $size = $request->file('file')->getSize() + $request->user()->current_files_size;

        if($size >= $request->user()->max_files_size){
            throw new HttpException(400, 'Disk space has run out');
        }

        $folder = $this->findFolder($request);

        $this->checkForUnique($folder, $request->file('file')->getClientOriginalName());

        $filePath = $request->file('file')->storeAs($folder->name, $request->file('file')->getClientOriginalName());

        $request->user()->current_files_size += $request->file('file')->getSize();

        $request->user()->save();

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
     * Delete file and counting size of all files

     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        $folder = $this->findFolder($request);

        $file = $folder->findFile($request->file_name);

        $path = FolderService::configurationFolderName($file->name, $folder->name);

        $request->user()->current_files_size -= Storage::disk('local')->size($path);

        $request->user()->save();

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

        $this->repository->updateFileName($file, $request->new_file_name);
    }

    /**
     * Publishing file

     * @param Request $request
     * @return string
     */
    public function publish(Request $request): string
    {
        $folder = $this->findFolder($request);

        $file = $folder->findFile($request->file_name);

         $publicLink = Str::random();

         $this->repository->setPublicLink($file, $publicLink);

         return $publicLink;
    }

    /**
     * Finding file path

     * @param File $file
     * @return string
     */
    public function getPublic(File $file): string
    {
        $path = FolderService::configurationFolderName($file->name, $file->folder->name);

        return Storage::disk('local')->path($path);
    }
}
