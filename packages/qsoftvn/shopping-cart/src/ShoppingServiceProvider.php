<?php

namespace Qsoftvn\ShoppingCart;

//use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ShoppingServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Qsoftvn\ShoppingCart\Http\Controllers';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'shopping');

        // $this->publishes([
        //     __DIR__ . '/config'          => config_path(),
        //     __DIR__ . '/resources/views' => resource_path('views/vendor/shopping'),

        // ]);

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'shopping');

        parent::boot();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Http\Kernel::class,
            \Qsoftvn\ShoppingCart\Http\Kernel::class
        );

        $this->mergeConfigFrom(
            __DIR__ . '/config/qsoftvn/shopping.php', 'qsoftvn.shopping'
        );
        $this->map();

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'shopping_admin',
            'namespace'  => $this->namespace,
            'prefix'     => config('qsoftvn.shopping.uri_prefix'),
        ], function ($router) {
            require __DIR__ . '/routes/web.php';
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require __DIR__ . '/routes/api.php';
        });
    }
}
