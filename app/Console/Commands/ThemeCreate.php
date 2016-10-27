<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Themes\Theme;
class ThemeCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:create {nameTheme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Theme';

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
        $this->theme->createThemeDir($name);
        $this->info('Theme created successfully.');
    }

    protected function getNameInput()
    {
        return trim($this->argument('nameTheme'));
    }
}
