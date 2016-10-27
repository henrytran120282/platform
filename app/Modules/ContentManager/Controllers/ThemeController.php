<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\Theme;
use App\Modules\ContentManager\Models\Themes;
use App\Modules\ContentManager\Models\ThemeMeta;
use App\Facades\Admin;
class ThemeController extends Controller
{
    public function index(){
    	$model = Themes::orderBy('status','desc')->get();
    	return view("ContentManager::theme.index",['models'=>$model]);
    }

    public function view($id){
        $model = Themes::find($id);
        return view("ContentManager::theme.view",['model'=>$model]);
    }

    public function update(Request $request){
    	$reqMeta = $request->meta;
    	$id = $request->idtheme;
        $beforeMeta = ThemeMeta::where('theme_id', $id)->where('meta_group', 'options')->get();
        foreach ($beforeMeta as $value) {
            $meta = unserialize($value->meta_value);
            $newMeta = [];
            foreach ($meta as $val) {
                $val['value'] = $reqMeta[$value->meta_key][$val['name']]['value'];
                $newMeta[] = $val;
            }
            ThemeMeta::where('theme_id', $id)->where('meta_key', $value->meta_key)->update(['meta_value' => serialize($newMeta)]);
        }
        return redirect(Admin::StrURL('contentManager/theme/'.$id))->with('success','Theme Option update success');  ;
    }

    public function active($id){
        Themes::where('status',1)->update(['status'=>0]);
        $activeTheme = Themes::find($id);
        $activeTheme->status = 1;
        $activeTheme->save();
        return redirect(Admin::StrURL('contentManager/theme'));
    }

    public function install(){
        $test = config('themes.smallpine');
        dd($test);
    }
}
