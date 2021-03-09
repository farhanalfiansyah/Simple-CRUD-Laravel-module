<?php

namespace App\Console\Commands\Module;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class ModuleMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'module:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if ($this->isModuleExist($name)) {
            $this->error("Module [{$name}] already exist!");

            return E_ERROR;
        }

        $this->generateFolders($name);
        $this->generateModuleManifestFile($name);
        $this->generateControllerFile($name);
        $this->generateRouteFile($name);
        $this->generateRouteProviderFile($name);
        $this->generateProviderFile($name);

        return 0;
    }

    protected function getModulePath($name)
    {
        return base_path("Modules/{$name}/");
    }

    protected function generateModuleManifestFile($name)
    {
        $path = $this->getModulePath($name) . 'module.json';
        $stub = $this->laravel['files']->get($this->resolveStubPath('/stubs/module/module.manifest.stub'));

        $stub = str_replace(
            ['{{ moduleName }}', '{{ moduleNameLower }}'],
            [$name, strtolower($name)],
            $stub
        );

        $this->laravel['files']->put($path, $stub);

        $this->info("Created : {$path}");
    }

    protected function generateControllerFile($name)
    {
        $path = $this->getModulePath($name) . 'Http/Controllers/Controller.php';
        $stub = $this->laravel['files']->get($this->resolveStubPath('/stubs/module/module.controller.stub'));

        $stub = str_replace(
            ['{{ moduleName }}', '{{ moduleNameLower }}'],
            [$name, strtolower($name)],
            $stub
        );

        $this->laravel['files']->put($path, $stub);

        $this->info("Created : {$path}");
    }

    protected function generateRouteFile($name)
    {
        $path = $this->getModulePath($name) . 'Routes/api.php';
        $stub = $this->laravel['files']->get($this->resolveStubPath('/stubs/module/module.route.stub'));

        $this->laravel['files']->put($path, $stub);

        $this->info("Created : {$path}");
    }

    protected function generateRouteProviderFile($name)
    {
        $path = $this->getModulePath($name) . 'Providers/RouteServiceProvider.php';
        $stub = $this->laravel['files']->get($this->resolveStubPath('/stubs/module/module.provider.route.stub'));

        $stub = str_replace(
            ['{{ moduleName }}', '{{ moduleNameLower }}'],
            [$name, strtolower($name)],
            $stub
        );

        $this->laravel['files']->put($path, $stub);

        $this->info("Created : {$path}");
    }

    protected function generateProviderFile($name)
    {
        $path = $this->getModulePath($name) . "Providers/{$name}ServiceProvider.php";
        $stub = $this->laravel['files']->get($this->resolveStubPath('/stubs/module/module.provider.stub'));

        $stub = str_replace(
            ['{{ moduleName }}', '{{ moduleNameLower }}'],
            [$name, strtolower($name)],
            $stub
        );

        $this->laravel['files']->put($path, $stub);

        $this->info("Created : {$path}");
    }

    protected function resolveStubPath($stub)
    {
        return base_path($stub);
    }

    protected function generateFolders($name)
    {
        foreach ($this->getFolders() as $folder) {
            $path = $this->getModulePath($name) . $folder;
            $this->makeDirectory($path);
        }
    }

    protected function makeDirectory($path)
    {
        if (!$this->laravel['files']->isDirectory($path)) {
            $this->laravel['files']->makeDirectory($path, 0777, true, true);
        }
    }

    protected function getFolders()
    {
        return [
            'Http/Controllers',
            'Models',
            'Providers',
            'Routes',
        ];
    }

    protected function isModuleExist($name)
    {
        return (bool) $this->laravel['files']->isDirectory($this->getModulePath($name));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The names of modules will be created.'],
        ];
    }
}
