<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\ContentManager\Models\Options;
use Admin;
class OptionsController extends Controller
{
    public function index(){
    	$model = Options::all();
    	$res = [];
    	foreach ($model as $opt) {
    		$res[$opt->name] = $opt->value;
    	}
    	return view("ContentManager::setting",['model'=>$res]);
    }

    public function update(Request $request){
        $this->validate($request, [
            'opt.site_title' => 'required',
            'opt.email_administrator' => 'required',
        ]);
        
        foreach ($request->opt as $key => $value) {
            Options::where('name', $key)->update(['value' => $value]);
        }

        return redirect(Admin::StrURL('contentManager/setting'))->with('status', 'Setting update success');
        
    }
}
