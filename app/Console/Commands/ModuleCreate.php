<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ModuleCreate extends Command
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
    protected $signature = 'module:create {modulename} {--database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->isDirectory($rawName);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('modulename'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modulePath = app_path('Modules/'.$this->getNameInput());
        

        if ($this->alreadyExists($modulePath)) {
            $this->error('Module already exists!');

            return false;
        }

        $this->makeDirectory($modulePath);

        $this->info('Module created successfully.');
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
            if($this->option('database')):
            $this->files->makeDirectory($path."/Database", 0777, true, true);
            endif;
            $this->files->makeDirectory($path."/Controllers", 0777, true, true);
            $this->files->makeDirectory($path."/Models", 0777, true, true);
            $this->files->makeDirectory($path."/Views", 0777, true, true);
        }
    }


    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_NONE, 'module with database tables.'],
        ];
    }
}
