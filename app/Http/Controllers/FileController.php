<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\DeleteFileRequest;
use App\Http\Requests\DownloadFileRequest;
use App\Http\Requests\PublishFileRequest;
use App\Http\Requests\RenameFileRequest;
use App\Http\Resources\FolderResource;
use App\Services\FileService;
use Illuminate\Http\Request;

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

        return response()->download($path, basename($path));
    }

    /**
     * Delete file

     * @param DeleteFileRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteFile(DeleteFileRequest $request)
    {
        $this->service->delete($request);

        return response(['message' => 'File deleted']);
    }

    /**
     * Rename file

     * @param RenameFileRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function renameFile(RenameFileRequest $request)
    {
        $this->service->rename($request);

        return response(['message' => 'File renamed']);
    }

    /**
     * Publish file and get random string

     * @param PublishFileRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function publishFile(PublishFileRequest $request)
    {
        $publicLink = $this->service->publish($request);

        return response(['message' => 'File published', 'public link' => $publicLink]);
    }
}
