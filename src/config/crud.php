<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Generator Config
    |--------------------------------------------------------------------------
    |
    */
    'generator' => [
        'basePath' => base_path(),
        'paths' => [
            'app_model' => 'App\Models',
            'controller_path' => 'Http\Controllers',
            'request_path' => 'Http\Requests',
            'resource_path' => 'Transformers',
            'repositories' => 'Repositories\Mysql',
            'repository_interfaces' => 'Contracts\Repositories\Mysql',
            'services' => 'Services',
            'service_interfaces' => 'Contracts\Services',
            'app_service_provider' => 'AppServiceProvider'
        ]
    ]
];
