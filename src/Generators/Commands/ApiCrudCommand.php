<?php

namespace VietNH\LaraEasyDev\Generators\Commands;

use Illuminate\Console\Command;

class ApiCrudCommand extends Command {
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:api-crud {model} {--module=}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a base api crud with a model';

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle()
    {
        $model = $this->argument('model');
        $module = $this->option('module');

        $this->call('make:repository', ['model' => $model, 'module' => $module]);
        $this->call('make:request', ['model' => $model, 'module' => $module]);
        $this->call('make:resource', ['model' => $model, 'module' => $module]);
        $this->call('make:controller', ['model' => $model, 'module' => $module]);
        $this->call('make:service', ['model' => $model, 'module' => $module]);
    }
}
