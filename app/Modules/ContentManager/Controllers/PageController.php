<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Modules\ContentManager\Models\Articles;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\TermRelationships;
use App\Http\Controllers\Controller;
use Admin;
use Theme;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Articles::where('post_type','page')->orderBy('id', 'desc')->paginate(10);
        return view("ContentManager::page.index",['model' => $model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ContentManager::page.create",["model"=>""]);
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
        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $request->post_content);
        $model->post_author = \Auth::guard('admin')->user()->id;
        $model->post_type = "page";
        $model->post_name = str_slug($request->post_title,"-");
        $model->post_title = $request->post_title;
        $model->post_content = $content;
        $model->post_status = $request->status;
        $model->save();
        Admin::userLog(\Auth::guard('admin')->user()->id,'Create page '.$request->post_title);
        foreach ($request->meta as $key => $value) {
           $model->meta()->updateOrCreate(["meta_key"=>$key],["meta_key"=>$key,"meta_value"=>$value]);
        }
        return redirect(Admin::StrURL('contentManager/page')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Articles::where("post_name",$slug)->where("post_type","page")->where('post_status','publish')->firstOrFail();
        $viewTheme = Theme::active().'.page.view';
        return view()->exists($viewTheme) ? view($viewTheme,['model'=>$model,'appTitle'=>$model->post_title]) : view("ContentManager::page.show",['model'=>$model,'appTitle'=>$model->post_title]);
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
        return view("ContentManager::page.update",['model' => $model]);
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
        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $request->post_content);
        $model->post_type = "page";
        $model->post_name = str_slug($request->post_title,"-");
        $model->post_title = $request->post_title;
        $model->post_content = $content;
        $model->post_status = $request->status;
        $model->save();
        Admin::userLog(\Auth::guard('admin')->user()->id,'Update page '.$request->post_title);
        foreach ($request->meta as $key => $value) {
           $model->meta()->updateOrCreate(["meta_key"=>$key],["meta_key"=>$key,"meta_value"=>$value]);
        }
        return redirect(Admin::StrURL('contentManager/page'));
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
        }else{
            Articles::destroy($id);              
        }
        Admin::userLog(\Auth::guard('admin')->user()->id,'Delete page id :'.$id);
    }
}
