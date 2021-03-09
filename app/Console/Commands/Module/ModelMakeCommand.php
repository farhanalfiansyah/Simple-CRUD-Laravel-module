<?php

namespace App\Console\Commands\Module;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '/stubs/module/model.stub';

        return $this->resolveStubPath($stub);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\'.$this->getModuleInput().'\Models';
    }
}
