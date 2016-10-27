<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use View;
use Helper;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('pushonce', function ($expression) {
            $isDisplayed = '__pushonce_'.trim(substr($expression, 2, -2));
            return "<?php if(!isset(\$__env->{$isDisplayed})): \$__env->{$isDisplayed} = true; \$__env->startPush{$expression}; ?>";
        });

        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });

        View::share('appTitle', "");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }
}
