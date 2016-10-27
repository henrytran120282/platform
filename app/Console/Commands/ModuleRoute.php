<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ModuleRoute extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:route {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'route';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->parseName("routes");

        $path = $this->getPath($name);

        if ($this->alreadyExists("routes")) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );

        $stub = str_replace(
            'ModuleName', $this->argument('name'), $stub
        );

        return $this;
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/route.module.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $moduleName = $this->argument('name');
        return $rootNamespace.'\Modules\\'.$moduleName;
    }
}
