<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Themes\Theme;
class ThemeUninstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:uninstall {nameTheme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall theme';

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
        if($name == "smallpine"){
            $this->error('This theme can\'t uninstall,because this theme is theme default.');
            return false;
        }else{
            $this->theme->uninstall($name);
            $this->info('Theme uninstall successfully.');
        }
    }

    protected function getNameInput()
    {
        return trim($this->argument('nameTheme'));
    }
}
