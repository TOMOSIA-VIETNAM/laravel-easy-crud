<?php

namespace VietNH\LaraEasyDev\Generators;

use VietNH\LaraEasyDev\Helpers\ModelHelper;

/**
 * Class ServiceGenerator
 * @package VietNH\LaraEasyDev\Generators
 */
class ServiceGenerator extends Generator
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:service {model} {module}';

    protected $type = 'Service';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create api service';

    protected function getInterfaceNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.service_interfaces')
        );
    }

    protected function getClassNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.services')
        );
    }

    protected function getInterfaceStub()
    {
        return __DIR__ . '/Stubs/ServiceInterfaceStub.stub';
    }

    protected function getClassStub()
    {
        return __DIR__ . '/Stubs/ServiceClassStub.stub';
    }

    /**
     * @return string
     */
    protected function getInterfaceNameInput()
    {
        return sprintf('%sService', $this->argument('model'));
    }

    protected function getClassNameInput()
    {
        return sprintf('%sServiceImpl', $this->argument('model'));
    }

    protected function replaceInterfaceStub($stub)
    {
        $stub = $this->replaceGeneral($stub);

        return str_replace(
            [
                '{{ module }}',
                '{{ model }}'
            ],
            [
                $this->argument('module'),
                $this->argument('model')
            ],
            $stub
        );
    }

    protected function replaceClassStub($stub)
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
            $this->getInterfaceNameInput(),
            $this->getInterfaceNamespace(),
            $this->getInterfaceStub(),
            'replaceInterfaceStub'
        );

        $this->generateFile(
            $this->getClassNameInput(),
            $this->getClassNamespace(),
            $this->getClassStub(),
            'replaceClassStub'
        );
    }
}
