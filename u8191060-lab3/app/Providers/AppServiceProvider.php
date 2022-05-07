<?php

namespace App\Providers;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BaseJsonResource::withoutWrapping();
    }
}
