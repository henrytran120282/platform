<?php

namespace Qsoftvn\ShoppingCart\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'shopping_admin' => [
            'web',
            'auth_admin:admin',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth_admin' => \Qsoftvn\ShoppingCart\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}
