<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        Commands\ModuleCreate::class,
        Commands\ModuleController::class,
        Commands\ModuleMigrate::class,
        Commands\ModuleRoute::class,
        Commands\ThemeCreate::class,
        Commands\ThemeInstall::class,
        Commands\ThemePublish::class,
        Commands\ThemeUninstall::class,
        Commands\ContentManagerGenerator::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }
}
