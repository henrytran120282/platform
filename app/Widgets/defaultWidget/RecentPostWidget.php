<?php 

namespace App\Widgets\defaultWidget;

use App\Widgets\BaseWidget;
use App\Modules\ContentManager\Models\Articles;

class RecentPostWidget extends BaseWidget
{
	public function __construct() {
    	$this->name = "Recent Post Widget";
        $this->description = 'This widget for show recent post';
        $this->options = [
            'title'=>'',
            'show'=>'3',
            'description'=>'',
        ];
    }

    public function form(){
        return \View::make('widgets.defaultWidget.RecentPostWidget.form',['options'=>$this->options])->render();               
    }

    public function run(){
    	$model = Articles::where("post_type","post")->take($this->options['show'])->skip(0)->get();
        return \View::make('widgets.defaultWidget.RecentPostWidget.run',['options'=>$this->options,'model'=>$model])->render(); 
    }
}