<?php 

namespace App\Widgets\defaultWidget;

use App\Widgets\BaseWidget;

class TextWidget extends BaseWidget
{
	public function __construct() {
    	$this->name = "Text Widget";
        $this->description = 'This widget for show text / html';
        $this->options = [
            'title'=>'',
            'text'=>'',
        ];
    }

    public function form(){
        return \View::make('widgets.defaultWidget.TextWidget.form',['options'=>$this->options])->render();               
    }

    public function run(){
        return \View::make('widgets.defaultWidget.TextWidget.run',['options'=>$this->options])->render();   
    }
}