<?php

namespace VietNH\LaraEasyDev\Generators;

use VietNH\LaraEasyDev\Helpers\ModelHelper;

/**
 * Class ServiceGenerator
 * @package VietNH\LaraEasyDev\Generators
 */
class RequestGenerator extends Generator
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:request {model} {module}';

    protected $type = 'Request';

    protected $currentRequest = '';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create api request';

    protected function getRequestNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.request_path')
        );
    }

    protected function getStub()
    {
        return __DIR__ . '/Stubs/RequestStub.stub';
    }

    protected function getRequestClassNames()
    {
        $model = $this->argument('model');

        return [
            "{$model}ListRequest",
            "{$model}CreateRequest",
            "{$model}UpdateRequest"
        ];
    }

    protected function generateDocs()
    {
        $fillables = ModelHelper::getFillable($this->argument('model'));

        $docBody = '';
        foreach ($fillables as $key => $fillable) {
            if ($key != count($fillables) - 1) {
                $docBody .= sprintf(" *              @OA\Property(property='%s', type='string'),\n", $fillable);
            } else {
                $docBody .= sprintf(" *              @OA\Property(property='%s', type='string')", $fillable);
            }
        }

        return $docBody;
    }

    protected function replaceClassStub($stub)
    {
        $stub = $this->replaceGeneral($stub);

        return str_replace(
            [
                '{{ request_class }}',
                '{{ module }}',
                '{{ docBody }}'
            ],
            [
                $this->currentRequest,
                $this->argument('module'),
                $this->generateDocs()
            ],
            $stub
        );

    }

    /**
     * @return bool|void|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        foreach ($this->getRequestClassNames() as $className) {
            $this->currentRequest = $className;

            $this->generateFile(
                $className,
                $this->getRequestNamespace(),
                $this->getStub(),
                'replaceClassStub'
            );
        }
    }
}
