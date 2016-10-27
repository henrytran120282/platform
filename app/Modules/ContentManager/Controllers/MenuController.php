<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Modules\ContentManager\Models\Menus;
use App\Modules\ContentManager\Models\ArticleMeta;
use App\Modules\ContentManager\Models\Articles;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\Options;
use App\Modules\ContentManager\Models\ThemeMeta;
use App\Modules\ContentManager\Models\TermRelationships;
use App\Http\Controllers\Controller;
use DB;
use App\Facades\Admin;
use App\Facades\Theme;
class MenuController extends Controller
{
    public function index($name = "main-menu")
    {
        $groupName = Options::where("name","menu_name")->first();
        if (!in_array($name, unserialize($groupName->value))) {
            return abort(404);
        } 
    	$model = Menus::join('post_meta', 'posts.id', '=', 'post_meta.post_id')
                ->where('post_meta.meta_key','_nav_item_parent')
                ->where('post_meta.meta_value','')
                ->where('posts.menu_group',$name)
                ->orderBy('posts.menu_order', 'asc')
                ->get();
        $page = Articles::where('post_type','page')->where('post_status','publish')->orderBy('id', 'desc')->get();    
        $post = Articles::where('post_type','post')->where('post_status','publish')->orderBy('id', 'desc')->get();
        $category = Terms::where("taxonomy","category")
                    ->where("parent",0)
                    ->get();
        $groupActive = $name;
        $themeMeta = ThemeMeta::where("theme_id",Theme::getID())->where("meta_group","menu_position")->get();
        return view("ContentManager::menu.index",[
                "model"=>$model,
                "page"=>$page,
                "post"=>$post,
                "category"=>$category,
                "groupName"=>unserialize($groupName->value),
                "groupActive"=>$groupActive,
                "themeMenu"=>$themeMeta
            ]);
    }

    public function addGroupMenu(Request $request){
        $this->validate($request, [
            'name_group' => 'required',
        ]);
        $groupName = Options::where("name","menu_name")->first();
        $tmp = unserialize($groupName->value);
        $model = Options::find($groupName->id);
        $tmp[] = str_slug($request->name_group);
        $model->value = serialize($tmp);
        $model->save();
        return redirect(Admin::StrUrl("contentManager/menu"));
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
            'datamenu' => 'required',
        ]);
        $data = $request->datamenu;
        $countData = count($data);
        for ($i=1; $i < $countData ; $i++) { 
            $idPost = $data[$i]["id"];
            $label =  $data[$i]["label"];
            $model = Menus::find($idPost);
            $model->post_title = $label;
            $model->menu_order = $i;
            $model->save();
            ArticleMeta::where("post_id",$idPost)->where("meta_key","_nav_item_parent")->update(['meta_value' => $data[$i]["parent_id"]]);
        }

        ThemeMeta::where("theme_id",Theme::getID())
        ->where("meta_group","menu_position")
        ->where("meta_value",$request->group)
        ->update(['meta_value'=>'']);

        if($request->thememenu != ""){
            ThemeMeta::where("theme_id",Theme::getID())
            ->where("meta_group","menu_position")
            ->where("meta_key",$request->thememenu)
            ->update(['meta_value'=>$request->group]);            
        }    
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
            'label' => 'required',
        ]);
        $model = new Menus();
    	$model->post_author = \Auth::guard('admin')->user()->id;
        $model->post_type = "nav-menu";
        $model->post_name = str_slug($request->label,"-");
        $model->post_title = $request->label;
        $model->menu_group = $request->group;
        $model->post_mime_type = "nav-menu";
        $model->comment_status = "close";
        $model->save();
        $meta = array(
		    array('post_id'=>$model->id, 'meta_key'=> '_nav_item_parent','meta_value'=> ""),
		    array('post_id'=>$model->id, 'meta_key'=> '_nav_item_url','meta_value'=> $request->url),
            array('post_id'=>$model->id, 'meta_key'=> '_nav_item_type','meta_value'=> $request->type),
		);
		ArticleMeta::insert($meta);
		return response()->json(['label' => $request->label, 'url' => $request->url,'id'=>$model->id]);
    }

    public function storemulti(Request $request)
    {
        $this->validate($request, [
            'datamenu' => 'required',
        ]);
        foreach ($request->datamenu as $value) {
            $type = $value["type"];
            $model = new Menus();
            $model->post_author = \Auth::guard('admin')->user()->id;
            $model->post_type = "nav-menu";
            $model->post_name = str_slug($value["label"],"-");
            $model->post_title = $value["label"];
            $model->menu_group = $request->group;
            $model->post_mime_type = "nav-menu";
            $model->comment_status = "close";
            $model->save();
            $meta = array(
                array('post_id'=>$model->id, 'meta_key'=> '_nav_item_parent','meta_value'=> ""),
                array('post_id'=>$model->id, 'meta_key'=> '_nav_item_url','meta_value'=> $value["url"]),
                array('post_id'=>$model->id, 'meta_key'=> '_nav_item_type','meta_value'=> $value["type"]),
            );
            ArticleMeta::insert($meta);
            $res = [
                ['label' => $value["label"], 'url' => $value["url"],'id'=>$model->id],
                ['label' => $value["label"], 'url' => $value["url"],'id'=>$model->id]
            ];
        }
        return response()->json($res);
    }

    public function destroy($id)
    {
        $model = Menus::join('post_meta', 'posts.id', '=', 'post_meta.post_id')
                ->where('posts.id', $id)
                ->first();
        foreach ($model->children() as $value) {
            $this->recursiveDelete($value);
        }
        Menus::destroy($id);
    }

    private function recursiveDelete($data){
        Menus::destroy($data->id);
        foreach ($data->children() as $value) {
            $this->recursiveDelete($value);
        }        
    }
}
