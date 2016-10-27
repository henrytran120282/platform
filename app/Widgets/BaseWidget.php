<?php 

namespace App\Widgets;

abstract class BaseWidget
{
    protected $id;
	public $name;
	public $description;
    public $options;

    public function __construct() {
    	$this->name = get_class($this);
        $this->description = 'No Descriptions';
        $this->options = [
            "baseID" => str_random(10),
            "title" => $this->name,
        ];
    }

    public function init($options){
        $this->id = $options['baseID'];
        $this->options = array_unique(array_merge($this->options,$options), SORT_REGULAR);
    }

    abstract protected function form();

    abstract protected function run();
}