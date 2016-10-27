<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\TermRelationships;
use App\Http\Controllers\Controller;
use App\Facades\Admin;
use Theme;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Terms::where("taxonomy","tag")->orderBy('term_id', 'desc')->paginate(10);
         $category = Terms::where("taxonomy","tag")
        ->where("parent",0)
        ->get();
        return view("ContentManager::tag.index",['model' => $model,"category"=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Terms();
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model->name = $request->name;
        if(!empty(trim($request->slug))):
            $model->slug = str_slug($request->slug,"-");
        else:
            $model->slug = str_slug($request->name,"-");
        endif;
        $model->term_group = 0;
        $model->taxonomy = "tag";
        $model->description = $request->description;
        $model->parent = 0;
        $model->save();
        return redirect(Admin::StrURL('contentManager/tag'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Terms::where("slug",$slug)->where('taxonomy','tag')->firstOrFail();
        if (view()->exists(Theme::active().'.post.archive')) {
            return view(Theme::active().'.post.archive',['model'=>$model,'appTitle'=>$model->name]);
        }else{
            return view("ContentManager::tag.show",['model'=>$model,'appTitle'=>$model->name]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Terms::find($id);
        $modelAll = Terms::where("taxonomy","tag")->orderBy('term_id', 'desc')->paginate(10);
        $category = Terms::where("taxonomy","tag")
        ->where("parent",0)
        ->get();
        return view("ContentManager::tag.update",['model' => $model,"category"=>$category,"modelAll"=>$modelAll]);
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
        $model = Terms::find($id);
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model->name = $request->name;
        if(!empty(trim($request->slug))):
            $model->slug = str_slug($request->slug,"-");
        else:
            $model->slug = str_slug($request->name,"-");
        endif;
        $model->term_group = 0;
        $model->taxonomy = "tag";
        $model->description = $request->description;
        $model->parent = 0;
        $model->save();
        return redirect(Admin::StrURL('contentManager/tag'));
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
            Terms::destroy($tmp);
            foreach ($tmp as $value) {
                TermRelationships::where("term_taxonomy_id",$value)->delete();
            }
        }else{
            Terms::destroy($id);  
            TermRelationships::where("term_taxonomy_id",$id)->delete();
        }
    }
}
