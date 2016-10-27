<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Themes\Theme;
class ThemePublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:publish {nameTheme} {--config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Theme Publish';

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
        $this->theme->checkFileConfig($name);
        if($this->theme->error()){
            foreach ($this->theme->getErrors() as $value) {
                $this->error($value);
            }
            $this->error('Theme not publish.');
            return false;
        }else{
            if($this->option('config')){
                $this->theme->insertToDB($name);
                $this->info('Config theme publish successfully.');  
            }else{
                $this->theme->setCompress($name);
                $this->info('Theme publish successfully.');    
            }
        }
    }

    protected function getNameInput()
    {
        return trim($this->argument('nameTheme'));
    }

    protected function getOptions()
    {
        return [
            ['config', null, InputOption::VALUE_NONE, 'Insert config to db.'],
        ];
    }
}
