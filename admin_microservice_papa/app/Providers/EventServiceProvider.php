<?php

namespace App\Providers;

use App\Jobs\ProductLiked;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \App::bindMethod(ProductLiked::class . '@handle', function ($job) {
            return $job->handle();
        });
    }
}
