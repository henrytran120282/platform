<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\Admin;
use App\Modules\ContentManager\Models\Articles;
class MediaController extends Controller
{
    public function index(){
    	$model = Articles::where('post_type','attachment')->orderBy('id', 'desc')->paginate(4);
    	if (\Request::ajax()) {
            return \Response::json(view('ContentManager::media.partials.table', array('model' => $model))->render());
        }
    	return view("ContentManager::media.index",['model'=>$model]);
    }

    public function images(Request $request){
        $model = Articles::where('post_type','attachment')->where('post_mime_type','LIKE','%image%')->orderBy('id', 'desc')->paginate(6);
        if ($request->ajax()) {
            if(isset($request->name)):
                return \Response::json(view('ContentManager::media.partials.selectimage', array('model' => $model,'name'=>$request->name))->render());
            else:
                return \Response::json(view('ContentManager::media.partials.selectimage', array('model' => $model))->render());
            endif;
        }
    }

    public function store(Request $request){
    	$this->validate($request, [
            'file' => 'required|filled',
        ]);
        $model = new Articles();
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();
        $pathUpload = public_path('uploads');
        $model->post_author = \Auth::guard('admin')->user()->id;
        $model->post_type = "attachment";
        $tmpName = str_replace(".".$fileExt,"",$fileName);
        $model->post_title = ucwords(str_replace("-", " ", $tmpName));
        $model->post_name = str_slug($tmpName,"-").".".$fileExt;
        $model->post_content = "";
        $model->post_status = "inherit";
        $model->post_mime_type = $file->getClientMimeType();
        if($model->save()){
            //$model->meta()->updateOrCreate(["meta_key"=>"_file_size"],["meta_key"=>"_file_size","meta_value"=>$file->getClientSize()]);
        	$file->move($pathUpload,$model->post_name);	
        }
    }

    public function destroy($id)
    {
        $tmp = explode(",", $id);
        if(is_array($tmp)){
            foreach ($tmp as $value) {
                $model = Articles::find($value);
                $this->deleteFile($model->post_name);
                $model->delete();    
            }
        }else{
            $model = Articles::find($id);
            $this->deleteFile($model->post_name);
            $model->delete();
        }
    }

    private function deleteFile($name){
        $path = public_path('uploads');
        if(file_exists($path."/".$name)){
            unlink($path."/".$name);
        }
    }
}
