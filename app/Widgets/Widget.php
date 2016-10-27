<?php 

namespace App\Widgets;
use App\Modules\ContentManager\Models\WidgetGroups;
use Theme;
class Widget
{
    public function group($nameGroup){
    	$themeActive = Theme::getID();
    	$group = WidgetGroups::where("name",$nameGroup)->where('theme_id',$themeActive)->first();
    	foreach ($group->widget() as $value) {
    		$class = new $value->class_name();
    		$class->init(unserialize($value->options));
    		echo $class->run();
    	}
    }
}