<?php

namespace VietNH\LaraEasyDev\Generators;

use VietNH\LaraEasyDev\Helpers\ModelHelper;

/**
 * Class RepositoryGenerator
 * @package VietNH\LaraEasyDev\Generators
 */
class RepositoryGenerator extends Generator
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:repository {model} {module}';

    protected $type = 'Repository';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create api repository';

    protected function getInterfaceNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.repository_interfaces')
        );
    }

    protected function getClassNamespace()
    {
        return sprintf(
            "%s\%s\%s",
            trim($this->rootNamespace(), '\\'),
            $this->argument("module"),
            config('crud.generator.paths.repositories')
        );
    }

    protected function getInterfaceStub()
    {
        return __DIR__ . '/Stubs/RepositoryInterfaceStub.stub';
    }

    protected function getClassStub()
    {
        return __DIR__ . '/Stubs/RepositoryClassStub.stub';
    }

    /**
     * @return string
     */
    protected function getInterfaceNameInput()
    {
        return sprintf('%sRepository', $this->argument('model'));
    }

    protected function getClassNameInput()
    {
        return sprintf('%sRepoImpl', $this->argument('model'));
    }

    protected function replaceInterfaceStub($stub)
    {
        return str_replace(
            [
                '{{ namespace }}',
                '{{ namespaceModel }}',
                '{{ interface }}',
                '{{ model }}',
                '{{ modelVariable }}'
            ],
            [
                $this->getInterfaceNamespace(),
                ModelHelper::getModelPath($this->argument('model')),
                $this->getInterfaceNameInput(),
                $this->argument('model'),
                lcfirst($this->argument('model'))
            ],
            $stub
        );
    }

    protected function replaceClassStub($stub)
    {
        return str_replace(
            [
                '{{ namespace }}',
                '{{ namespaceModel }}',
                '{{ namespaceInterface }}',
                '{{ class }}',
                '{{ interface }}',
                '{{ model }}',
                '{{ modelVariable }}'
            ],
            [
                $this->getClassNamespace(),
                ModelHelper::getModelPath($this->argument('model')),
                sprintf('%s\%s', $this->getInterfaceNamespace(), $this->getInterfaceNameInput()),
                $this->getClassNameInput(),
                $this->getInterfaceNameInput(),
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
            'replaceInterfaceStub');

        $this->generateFile(
            $this->getClassNameInput(),
            $this->getClassNamespace(),
            $this->getClassStub(),
            'replaceClassStub'
        );
    }
}
