<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\ContentManager\Models\Comments;

class CommentsController extends Controller
{
    public function index(){
    	$model = Comments::orderBy('id', 'desc')->paginate(10);
    	return view("ContentManager::comment.index",["model"=>$model]);
    }

    public function approve($id){
    	$model = Comments::find($id);
    	if($model->approved){
    		$model->approved = false;
    	}else{
    		$model->approved = true;
    	}
    	$model->save();
    	return redirect(\Admin::StrURL('contentManager/comment')); 
    }

    public function destroy($id)
    {
        $tmp = explode(",", $id);
        if(is_array($tmp)){
            Comments::destroy($tmp);
        }else{
            Comments::destroy($id);              
        }
    }
}
