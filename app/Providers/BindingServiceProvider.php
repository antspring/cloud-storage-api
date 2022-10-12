<?php

namespace App\Providers;

use App\Http\Repository\FileRepository;
use App\Http\Repository\FolderRepository;
use App\Http\Repository\Interfaces\FileInterface;
use App\Http\Repository\Interfaces\FolderInterface;
use App\Http\Repository\Interfaces\UserInterface;
use App\Http\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UserInterface::class => UserRepository::class,
        FolderInterface::class => FolderRepository::class,
        FileInterface::class => FileRepository::class
    ];
}
