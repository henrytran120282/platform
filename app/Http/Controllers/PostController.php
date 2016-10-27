<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Modules\ContentManager\Models\Articles;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\TermRelationships;
use App\Http\Requests;
use App\Facades\Theme;


class PostController extends Controller
{
    public function index(){
        $res = array();
        $data = Articles::where('post_type','post')->orderBy('id', 'desc')->get();
       
        foreach ($data as $value) {
            $res[] = [
                'id'=>$value->id,
                'excerpt'=>$value->post_excerpt,
                'title'=>$value->post_title,
                'created'=>$value->created_at,
                'content'=>$value->post_content,
                'image'=>$value->getMetaValue('featured_img'),
            ];
        }
        return response()->json(['datas' => $res]);
    	//return view(Theme::active().'.post.index');
       
    }

    public function view($slug){
        $model = Articles::where("post_name",$slug)->firstOrFail();
    	return view(Theme::active().'.post.view',["model"=>$model]);
    }

    public function category($slug){
    	$model = Terms::where("slug",$slug)->first();
        print_r($model);

    	//return view(Theme::active().'.post.view',["model"=>$model]);
    }
}
