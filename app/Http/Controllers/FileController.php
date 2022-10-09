<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Services\FileService;

class FileController extends Controller
{
    public function __construct(private FileService $service){}

    public function createFile(CreateFileRequest $request)
    {
        $this->service->create($request);

        return response(['message' => 'File uploaded']);
    }
}
