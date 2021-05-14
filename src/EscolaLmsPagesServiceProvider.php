<?php

namespace EscolaLms\Pages;

use Illuminate\Support\ServiceProvider;

class EscolaLmsPagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'pages-migrations');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if (!config('escolalms.tags.ignore_migrations')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }
}
