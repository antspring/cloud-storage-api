<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateFolderRequest;
use App\Services\FolderService;

class FolderController extends Controller
{
    public function __construct(private FolderService $service){}

    /**
     * Create Folder action

     * @param CreateFolderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createFolder(CreateFolderRequest $request)
    {
        $request['folder_name'] = $this->service->configurationFolderName($request->folder_name, $request->user()->name);

        $request->validate(['folder_name' => 'unique:folders,name']);

        $this->service->create($request->folder_name, $request->user()->id);

        return response(['message' => 'Folder created']);
    }
}
