<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\ContentManager\Models\Articles;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\Comments;
class DefaultController extends Controller
{
    public function index(){
    	$post = Articles::where("post_type","post")->count();
    	$page = Articles::where("post_type","page")->count();
    	$category = Terms::where("taxonomy","category")->count();
    	$comment = Comments::where("approved",1)->count();
    	return view("ContentManager::index",[
    			'post'=>$post,
    			'page'=>$page,
    			'category'=>$category,
    			'comment'=>$comment,
    		]);
    }
}
