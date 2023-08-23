<?php

namespace VietNH\LaraEasyDev;

Use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use VietNH\LaraEasyDev\Generators\Commands\ApiCrudCommand;
use VietNH\LaraEasyDev\Generators\ControllerGenerator;
use VietNH\LaraEasyDev\Generators\RepositoryGenerator;
use VietNH\LaraEasyDev\Generators\RequestGenerator;
use VietNH\LaraEasyDev\Generators\ResourceGenerator;
use VietNH\LaraEasyDev\Generators\ServiceGenerator;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands(ApiCrudCommand::class);
        $this->commands(RepositoryGenerator::class);
        $this->commands(ServiceGenerator::class);
        $this->commands(RequestGenerator::class);
        $this->commands(ResourceGenerator::class);
        $this->commands(ControllerGenerator::class);
    }

    /**
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/crud.php' => App::configPath('crud.php')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/crud.php', 'crud');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
