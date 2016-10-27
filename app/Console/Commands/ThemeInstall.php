<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Themes\Theme;
class ThemeInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:install {nameTheme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Intall Theme';

    protected $theme;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Theme $theme)
    {
        parent::__construct();
        $this->theme = $theme;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->getNameInput();
        $this->theme->install($name);
        $error = $this->theme->getErrors();
        if(count($error) > 0){
            $this->error($error[0]);
            return false;
        }else{
            $this->info('Theme install successfully.');    
        }
    }

    protected function getNameInput()
    {
        return trim($this->argument('nameTheme'));
    }
}
