<?php 

namespace App\Widgets\defaultWidget;

use App\Widgets\BaseWidget;
use App\Modules\ContentManager\Models\Terms;
class CategoryWidget extends BaseWidget
{
	public function __construct() {
    	$this->name = "Category Widget";
        $this->description = 'This widget for show category';
        $this->options = [
            'title'=>'',
            'type'=>'',
        ];
    }

    public function form(){
        $model = Terms::where("taxonomy","category")->get();
        return \View::make('widgets.defaultWidget.CategoryWidget.form',['options'=>$this->options,'model'=>$model])->render();               
    }

    public function run(){
    	$category = Terms::where("taxonomy","category")->get();
        return \View::make('widgets.defaultWidget.CategoryWidget.run',['options'=>$this->options,'model'=>$category])->render();   
    }
}