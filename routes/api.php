<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/create-folder', [FolderController::class, 'createFolder']);

    Route::post('/save-file', [FileController::class, 'createFile']);

    Route::get('/files-list', [FileController::class, 'fileList']);

    Route::get('/download-file', [FileController::class, 'downloadFile']);

    Route::delete('/delete-file', [FileController::class, 'deleteFile']);

    Route::patch('/rename-file', [FileController::class, 'renameFile']);

    Route::get('/publish-file', [FileController::class, 'publishFile']);

    Route::get('/public-file/{file:public_link}', [FileController::class, 'getPublicFile']);

    Route::get('/scan-folder', [FolderController::class, 'scanFolder']);
});
