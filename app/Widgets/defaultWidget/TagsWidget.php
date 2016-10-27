<?php 

namespace App\Widgets\defaultWidget;

use App\Widgets\BaseWidget;
use App\Modules\ContentManager\Models\Terms;
class TagsWidget extends BaseWidget
{
	public function __construct() {
    	$this->name = "Tag Widget";
        $this->description = 'This tag for show category';
        $this->options = [
            'title'=>'',
            'type'=>'',
        ];
    }

    public function form(){
        $model = Terms::where("taxonomy","tag")->get();
        return \View::make('widgets.defaultWidget.TagsWidget.form',['options'=>$this->options,'model'=>$model])->render();
    }

    public function run(){
    	$category = Terms::where("taxonomy","tag")->get();
        return \View::make('widgets.defaultWidget.TagsWidget.run',['options'=>$this->options,'model'=>$category])->render();   
    }
}