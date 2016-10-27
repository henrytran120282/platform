<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\Theme;
use App\Modules\ContentManager\Models\WidgetGroups;
use App\Modules\ContentManager\Models\Widget as ModelWidget;

class WidgetController extends Controller
{
    public function index(){
        $widgetGroups = WidgetGroups::where("theme_id",Theme::getID())->get();
        $default = $this->listDirWidget("defaultWidget");
        $theme = $this->listDirWidget(Theme::strActive());
    	return view("ContentManager::widget.index",[
                'default'=>$default,
                'theme'=>$theme,
                "widgetGroups"=>$widgetGroups
            ]);
    }

    public function store(Request $request){
        $tmp = $request->widget;
        unset($tmp['id']);
        $model = ModelWidget::find($request->widget['id']);
        $model->options = serialize($tmp);
        $model->save();
    }

    public function reorder(Request $request){
        $data = $request->datawidget;
        $countData = count($data);
        for ($i=1; $i < $countData ; $i++) { 
            $id = $data[$i]["id"];
            $model = ModelWidget::find($id);
            $model->order = $i;
            $model->save();
        }
    }

    public function destroy($id){
        ModelWidget::destroy($id);
    }

    public function addWidget(Request $request){
        $this->validate($request, [
            'className' => 'required',
            'position' => 'required',
        ]);
        $tmp = $request->className;
        $widget = new $tmp();
        $widget->init(["baseID"=>str_random(10),'title'=>$widget->name]);
        $model = new ModelWidget();
        $model->group_id = $request->position;
        $model->class_name = $request->className;
        $model->options = serialize($widget->options);
        $model->order = 0;
        $model->save();
    }

    private function listDirWidget($pathWidget){
        $res = [];
        $path = app_path('Widgets/'.$pathWidget);
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $tmp = 'App\\Widgets\\'.$pathWidget.'\\'.basename($entry, '.php');
                    $class = new $tmp(); 
                    $res[] = $class;
                }
            }
            closedir($handle);
        }
        return $res;
    }
}
