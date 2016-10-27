<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Widget extends Facade{
    protected static function getFacadeAccessor() { return 'App\Widgets\Widget'; }
}