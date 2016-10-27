<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ContentManagerGenerator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ContentManager:generate {name} {moduleName} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'controller';

    private $SmallName;

    private $BigName;

    private $ModuleName;

    private $routeModule;

    private $controllerName;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name = $this->argument('name');
        $this->smallBigName($name);
        $this->ModuleName = $this->argument('moduleName');
        $this->controllerName = $name;
        $this->routeModule = strtolower($this->ModuleName);
        $path = public_path('testing');
        foreach ($this->listGenerate() as $value) {
            $this->type = $value['name'];
            $this->makeDirectory($value['path']);
            $stub = $this->files->get($this->getStub());
            $this->files->put($value['file'], $this->replaceNamestub($stub));
        }
        $this->info('Genarate successfully.');
    }

    protected function makeDirectory($path){
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
    }

    public function listGenerate(){
        $path = app_path('Modules');
        return [
                    [
                        'name' =>'controller',
                        'file' =>$path.'/'.$this->ModuleName.'/Controllers/'.$this->controllerName.'.php',
                        'path' =>$path.'/'.$this->ModuleName.'/Controllers',
                    ],
                    [
                        'name' =>'index',
                        'file' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName.'/index.blade.php',
                        'path' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName,
                    ],
                    [
                        'name' =>'create',
                        'file' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName.'/create.blade.php',
                        'path' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName,
                    ],
                    [
                        'name' =>'update',
                        'file' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName.'/update.blade.php',
                        'path' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName,
                    ],
                    [
                        'name' =>'show',
                        'file' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName.'/show.blade.php',
                        'path' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName,
                    ],
                    [
                        'name' =>'form',
                        'file' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName.'/partials/form.blade.php',
                        'path' =>$path.'/'.$this->ModuleName.'/Views/'.$this->SmallName.'/partials',
                    ],
                ];
    }

    protected function replaceNamestub(&$stub)
    {
        $stub = str_replace(
            'SmallName', $this->SmallName, $stub
        );

        $stub = str_replace(
            'BigName', $this->BigName, $stub
        );

        $stub = str_replace(
            'ModuleName', $this->ModuleName, $stub
        );

        $stub = str_replace(
            'routeModule', $this->routeModule, $stub
        );

        $stub = str_replace(
            'controllerName', $this->controllerName, $stub
        );

        return $stub;
    }

    protected function getStub()
    {
        switch ($this->type) {
            case 'index':
                return __DIR__.'/stubs/ContentManager/index.blade.stub';
                break;
            
            case 'form':
                return __DIR__.'/stubs/ContentManager/form.blade.stub';
                break;

            case 'create':
                return __DIR__.'/stubs/ContentManager/create.blade.stub';
                break;
                
            case 'update':
                return __DIR__.'/stubs/ContentManager/update.blade.stub';
                break;
                
            case 'index':
                return __DIR__.'/stubs/ContentManager/index.blade.stub';
                break;

            case 'show':
                return __DIR__.'/stubs/ContentManager/show.blade.stub';
                break;    

            default:
                return __DIR__.'/stubs/ContentManager/default.controller.stub';
                break;
        }
        
    }

    public function smallBigName($controllerName){
        $snakeCase = snake_case($controllerName);
        $tmp = explode("_", $snakeCase);
        $this->SmallName = strtolower($tmp[0]);
        $this->BigName = ucfirst($tmp[0]);
    }
}
