<?php

namespace App\Services\Traits;

use App\Models\Folder;
use App\Services\FolderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait FileServiceHelpers
{
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
     * Check for uniqueness

     * @param Folder $folder
     * @param $fileName
     * @return void
     */
    public function checkForUnique(Folder $folder, $fileName): void
    {
        $folder->files()->each(function ($item) use ($fileName) {
            if ($item->name === $fileName){
                throw new HttpException(400, 'File already exists');
            }
        });
    }

    /**
     * Compose data for create model File

     * @param string $name
     * @param int $id
     * @param int $size
     * @param string|null $expirationDate
     * @return array
     */
    public function configurationFileData(string $name, int $id, int $size, ?string $expirationDate): array
    {
        return [
            'name' => $name,
            'folder_id' => $id,
            'size' => $size,
            'expiration_date' => $expirationDate
        ];
    }
}
