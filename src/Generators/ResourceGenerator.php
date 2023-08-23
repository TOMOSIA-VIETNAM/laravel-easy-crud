<?php

namespace VietNH\LaraEasyDev\Generators;

use VietNH\LaraEasyDev\Helpers\ModelHelper;

/**
 * Class ResourceGenerator
 * @package VietNH\LaraEasyDev\Generators
 */
class ResourceGenerator extends Generator
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:resource {model} {module}';

    protected $type = 'Resource';

    protected $current = '';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create api resource';

    protected function getResourceNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.resource_path')
        );
    }

    protected function getResourceStub()
    {
        return __DIR__ . '/Stubs/ResourceStub.stub';
    }

    protected function getResourcesStub()
    {
        return __DIR__ . '/Stubs/ResourcesStub.stub';
    }

    protected function getResourceClassName()
    {
        $model = $this->argument('model');

        return "{$model}Resource";
    }

    protected function getResourcesClassName()
    {
        $model = $this->argument('model');

        return "{$model}sResource";
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
                '{{ resource_class }}',
                '{{ module }}',
                '{{ docBody }}'
            ],
            [
                $this->current,
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
        $this->current = $this->getResourceClassName();
        $this->generateFile(
            $this->current,
            $this->getResourceNamespace(),
            $this->getResourceStub(),
            'replaceClassStub'
        );

        $this->current = $this->getResourcesClassName();
        $this->generateFile(
            $this->current,
            $this->getResourceNamespace(),
            $this->getResourcesStub(),
            'replaceClassStub'
        );
    }
}
