<?php 
namespace App\Modules;
use Illuminate\Foundation\AliasLoader; 
/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @package App\Modules
*/
class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     */
    public $admin;

    public function boot()
    {
        // For each of the registered modules, include their routes and Views
        $modules = config("module.modules");
        $this->admin = config("module.backend");

        foreach ($modules as $module => $value) {
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
            if(is_dir(__DIR__.'/'.$module.'/Database')) {
                $this->publishes([
                    __DIR__.'/'.$module.'/Database/' => database_path('/migrations')
                ], 'migrations');
            }
        }
    }

    public function register() {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Admin', 'App\Facades\Admin');
            $file = app_path('Helpers/Admin.php');
            if (file_exists($file)) {
                include $file;
            }
        });

    }

}