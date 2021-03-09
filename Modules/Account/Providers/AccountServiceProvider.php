<?php

namespace Modules\Account\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Account\Repositories\UserRepository;
use Modules\Account\Repositories\EloquentUserRepository;

class AccountServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepository::class => EloquentUserRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
