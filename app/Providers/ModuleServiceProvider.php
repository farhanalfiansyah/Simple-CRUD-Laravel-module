<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ModuleServiceProvider extends ServiceProvider
{
    private $modules;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadModules();
        $this->registerProviders();
    }

    private function registerProviders()
    {
        foreach ($this->modules as $module) {
            foreach ($module['providers'] as $provider) {
                $this->app->register($provider);
            }
        }
    }

    private function loadModules()
    {
        $this->modules = $this->scan();
    }

    private function scan(): array
    {
        $modules = [];
        $path = Str::finish(base_path('Modules'), '/*');

        $manifests = $this->app['files']->glob("{$path}/module.json");

        foreach ($manifests as $manifest) {
            $modules[] = $this->parseJson($manifest);
        }

        return $modules;
    }

    private function parseJson($path)
    {
        return json_decode($this->app['files']->get($path), true);
    }
}
