<?php 

namespace App\Widgets\defaultWidget;

use App\Widgets\BaseWidget;
use App\Modules\ContentManager\Models\Terms;
class CategoryWidget extends BaseWidget
{
	public function __construct() {
        $model = Terms::where("taxonomy","category")->get();
        $categoryList = [];
        if(count($model->toArray()) > 0){
            foreach ($model as $category){
                $categoryList[$category->term_id] = $category->name;
            }
        }
    	$this->name = "Category Widget";
        $this->description = 'This widget for show category';
        $this->options = [
            'title'=>'',
            'categoryList'=>$categoryList,
            'type' => ''
        ];
    }

    public function form(){
        $model = Terms::where("taxonomy","category")->get();
        return \View::make('widgets.defaultWidget.CategoryWidget.form',['options'=>$this->options,'model'=>$model])->render();               
    }

    public function run(){
        if($this->options['type'] == 0) {
            $category = Terms::where("taxonomy", "category")->get();
        }
        else {
            $category = Terms::where("taxonomy", "category")->where('term_id', $this->options['type'])->get();
        }

        return \View::make('widgets.defaultWidget.CategoryWidget.run',['options'=>$this->options,'model'=>$category])->render();   
    }
}