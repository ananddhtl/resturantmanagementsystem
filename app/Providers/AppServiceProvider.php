<?php

namespace App\Providers;

use App\Models\File;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();

        $all_images = File::query()->orderBy('id', 'DESC')->get();
        view()->share('all_images', $all_images);
    }
}
