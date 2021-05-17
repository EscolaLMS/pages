<?php

namespace EscolaLms\Pages;

use EscolaLms\Core\Providers\Injectable;
use EscolaLms\Pages\Http\Services\Contracts\PageServiceContract;
use EscolaLms\Pages\Http\Services\PageService;
use EscolaLms\Pages\Http\Exceptions\Handler;
use EscolaLms\Pages\Repository\Contracts\PageRepositoryContract;
use EscolaLms\Pages\Repository\PageRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;

class EscolaLmsPagesServiceProvider extends ServiceProvider
{
    use Injectable;

    private const CONTRACTS = [
        PageRepositoryContract::class => PageRepository::class,
        PageServiceContract::class => PageService::class,
    ];

    public function register()
    {
        parent::register();
        $this->injectContract(self::CONTRACTS);
    }

    public function boot()
    {
        $this->app->bind(
            ExceptionHandler::class, Handler::class
        );

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'pages-migrations');

        $this->publishes([
            __DIR__ . '/../database/seeders' => database_path('seeders'),
        ], 'pages-seeders');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if (!config('escolalms.tags.ignore_migrations')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }
}
