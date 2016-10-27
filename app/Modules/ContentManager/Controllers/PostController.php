<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Modules\ContentManager\Models\Articles;
use App\Modules\ContentManager\Models\Comments;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\TermRelationships;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Facades\Admin;
use App\Facades\Theme;
class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Articles::where('post_type','post')->orderBy('id', 'desc')->paginate(10);
        return view("ContentManager::post.index",['model' => $model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Terms::where("taxonomy","category")->where("parent",0)->get();
        return view("ContentManager::post.create",["category"=>$category,"model"=>""]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Articles();
        $this->validate($request, [
            'post_content' => 'required',
            'status' => 'required',
            'post_title' => 'required|max:255',
        ]);
        //--Set object from submit form
        $model->post_author = \Auth::guard('admin')->user()->id;
        $model->post_type = "post";
        $model->post_name = str_slug($request->post_title,"-");
        $model->post_title = $request->post_title;
        $model->comment_status = $request->comment_status;
        $model->post_content = $model->cleanContent($request->post_content);
        $model->post_excerpt = $model->cleanContent($request->post_excerpt);
        $model->post_status = $request->status;
        $model->save();
        //--Set log for user created post
        Admin::userLog(\Auth::guard('admin')->user()->id,'Create post '.$request->post_title);
        TermRelationships::destroy($model->id);
        foreach ($request->meta as $key => $value) {
           $model->meta()->updateOrCreate(["meta_key"=>$key],["meta_key"=>$key,"meta_value"=>$value]);
        }
        $tags = array_filter(explode(",",$request->tags));
        foreach ($tags as $tag) {
            $tr = Terms::updateOrCreate(['slug' => str_slug($tag,"-")],['name'=>$tag,"slug"=>str_slug($tag,"-"),"taxonomy"=>"tag"]);
            TermRelationships::create(["object_id" => $model->id,"term_taxonomy_id" => $tr->term_id]);
        }
        if(count($request->catname) > 0):
        foreach ($request->catname as $cat) {
            TermRelationships::create(["object_id" => $model->id,"term_taxonomy_id" => $cat]);
        }
        endif;
        return redirect(Admin::StrURL('contentManager/post'));            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Articles::where("post_name",$slug)->where("post_type","post")->where('post_status','publish')->firstOrFail();
        $model->post_hit = $model->post_hit+1;
        $model->save();
        $prevPost = Articles::where('id', '<', $model->id)->where("post_type","post")->where('post_status','publish')->orderBy("id","desc")->first();
        $nextPost = Articles::where('id', '>', $model->id)->where("post_type","post")->where('post_status','publish')->orderBy("id","asc")->first();
        $viewTheme = Theme::active().'.post.view';
        $shared = [
            'model'=>$model,
            'appTitle'=>$model->post_title,
            'nextPost'=>$nextPost,
            'prevPost'=>$prevPost,
        ];
        return view()->exists($viewTheme) ? view($viewTheme,$shared) : view("ContentManager::post.show",$shared);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Articles::find($id);
        $category = Terms::where("taxonomy","category")->where("parent",0)->get();
        $tags = TermRelationships::where("object_id",$id)->with("terms")->get();
        return view("ContentManager::post.update",['model' => $model,"category"=>$category,"tags"=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Articles::find($id);
        $this->validate($request, [
            'post_content' => 'required',
            'status' => 'required',
            'post_title' => 'required|max:255',
        ]);
        $model->post_type = "post";
        $model->post_name = str_slug($request->post_title,"-");
        $model->post_title = $request->post_title;
        $model->comment_status = $request->comment_status;
        $model->post_content = $model->cleanContent($request->post_content);
        $model->post_excerpt = $model->cleanContent($request->post_excerpt);
        $model->post_status = $request->status;
        $model->save();
        Admin::userLog(\Auth::guard('admin')->user()->id,'Update post '.$request->post_title);
        TermRelationships::destroy($model->id);
        foreach ($request->meta as $key => $value) {
           $model->meta()->updateOrCreate(["meta_key"=>$key],["meta_key"=>$key,"meta_value"=>$value]);
        }
        $tags = array_filter(explode(",",$request->tags));
        foreach ($tags as $tag) {
            $tr = Terms::updateOrCreate(['slug' => str_slug($tag,"-")],['name'=>$tag,"slug"=>str_slug($tag,"-"),"taxonomy"=>"tag"]);
            TermRelationships::create(["object_id" => $model->id,"term_taxonomy_id" => $tr->term_id]);
        }
        if(count($request->catname) > 0):
        foreach ($request->catname as $cat) {
            TermRelationships::create(["object_id" => $model->id,"term_taxonomy_id" => $cat]);
        }
        endif;
        return redirect(Admin::StrURL('contentManager/post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tmp = explode(",", $id);
        if(is_array($tmp)){
            Articles::destroy($tmp);
            TermRelationships::destroy($tmp);    
        }else{
            Articles::destroy($id);  
            TermRelationships::destroy($id);      
        }
        Admin::userLog(\Auth::guard('admin')->user()->id,'Delete post id :'.$id);
    }

    public function tagsJson(){
        $array = ['result'=>[
                                'test'=>'tesadasst',
                                'tesft'=>'tesagdfdasst',
                                'tes2t'=>'tesagdfgdfdasst',
                                'tes3t'=>'tesagfdgdfdasst',
                                'tesst'=>'tesandfgdasst',
                            ]
                ];
        return json_encode($array);
        //return Terms::where("taxonomy","tag")->get()->toJson();
    }

    public function addComment(Request $request, $slug){
        $model = Articles::where("post_name",$slug)->firstOrFail();
        $this->validate($request, [
            'comment_name' => 'required',
            'comment_email' => 'required|email',
            'comment_content' => 'required',
        ]);
        $comment = new Comments();
        $comment->post_id = $model->id;
        $comment->author = $request->comment_name;
        $comment->email = $request->comment_email;
        $comment->content = $request->comment_content;
        $comment->save();
        
        return redirect(url('/'.$slug)); 
    }

    public function blog(){
        $model = Articles::where("post_type","post")->get();
        $viewTheme = Theme::active().'.post.index';
        if(view()->exists($viewTheme)){
            view($viewTheme,['model'=>$model]);
        }else{
            abort(404);
        }
    }
}
