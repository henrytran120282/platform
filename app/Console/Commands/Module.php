<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Module extends Command
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
    protected $signature = 'make:module {namemodule}';

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
        return trim($this->argument('namemodule'));
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

        $this->files->put($modulePath."/routes.php", "");

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
            $this->files->makeDirectory($path."/Controllers", 0777, true, true);
            $this->files->makeDirectory($path."/Models", 0777, true, true);
            $this->files->makeDirectory($path."/Views", 0777, true, true);
        }
    }
}
