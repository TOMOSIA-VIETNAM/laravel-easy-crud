<?php

namespace VietNH\LaraEasyDev\Generators;

use VietNH\LaraEasyDev\Helpers\ModelHelper;

/**
 * Class ServiceGenerator
 * @package VietNH\LaraEasyDev\Generators
 */
class ControllerGenerator extends Generator
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:controller {model} {module}';

    protected $type = 'Controller';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create api controller';

    protected function getClassNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.controller_path')
        );
    }

    protected function getStub()
    {
        return __DIR__ . '/Stubs/ControllerStub.stub';
    }

    protected function getNameInput()
    {
        return sprintf('%sController', $this->argument('model'));
    }

    protected function replaceStub($stub)
    {
        $stub = $this->replaceGeneral($stub);

        return str_replace(
            [
                '{{ module }}',
                '{{ model }}',
                '{{ lc_model }}'
            ],
            [
                $this->argument('module'),
                $this->argument('model'),
                lcfirst($this->argument('model'))
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
        $this->generateFile(
            $this->getNameInput(),
            $this->getClassNamespace(),
            $this->getStub(),
            'replaceStub'
        );
    }
}
