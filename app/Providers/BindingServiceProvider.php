<?php

namespace App\Providers;

use App\Http\Repository\Contracts\UserContract;
use App\Http\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public array $bindings = [
      UserContract::class => UserRepository::class
    ];
}
