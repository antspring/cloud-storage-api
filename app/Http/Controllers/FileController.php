<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\DownloadFileRequest;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use App\Services\FileService;
use App\Services\FolderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __construct(private FileService $service){}

    /**
     * Create File action

     * @param CreateFileRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createFile(CreateFileRequest $request)
    {
        $this->service->create($request);

        return response(['message' => 'File uploaded']);
    }

    /**
     * Get all user files

     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fileList(Request $request)
    {
        return FolderResource::collection($request->user()->folders);
    }

    /**
     * Download file

     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(DownloadFileRequest $request)
    {
        $path = $this->service->download($request);

        $path = Storage::disk('local')->path($path);

        return response()->download($path, basename($path));
    }
}
