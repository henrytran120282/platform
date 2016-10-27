<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModuleMigrate extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migrate {modulename} {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crate / drop tables in module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modulename = $this->getNameInput();
        $this->listDirDatabase($modulename);
        $this->info("Module ".ucwords($modulename)." migrate success");
    }

    private function listDirDatabase($modulename){
        $path = app_path('Modules/'.$modulename.'/Database/');
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $nameClass = studly_case($entry);
                    include $path."/".$entry;
                    $tmp = '\\App\\Modules\\'.$modulename.'\\Database\\'.basename($nameClass, '.php');
                    $class = new $tmp();
                    if($this->option('reset')):
                        $class->down(); 
                    else:
                        $class->up();
                    endif;
                }
            }
            closedir($handle);
        }
    }

    protected function getNameInput()
    {
        return trim($this->argument('modulename'));
    }

    protected function getOptions()
    {
        return [
            ['reset', null, InputOption::VALUE_NONE, 'reset all table module.'],
        ];
    }
}
