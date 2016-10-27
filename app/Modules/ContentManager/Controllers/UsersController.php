<?php

namespace App\Modules\ContentManager\Controllers;

use Illuminate\Http\Request;
use App\User;
use Admin;
use App\Http\Controllers\Controller;
use App\Modules\ContentManager\Models\Articles;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = User::where("id","!=",1)->orderby("id","desc")->paginate(10);
        return view("ContentManager::user.index",['model' => $model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ContentManager::user.create",['model' => ""]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new User();
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = bcrypt($request->password);
        $model->description = $request->description;
        $model->photo = $request->photo;
        $model->save();
        return redirect(Admin::StrURL('contentManager/user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = User::find($id);
        $post = Articles::where('post_author',$id)->where('post_type','post')->orderby('id','desc')->get();
        return view('ContentManager::user.profile',['model'=>$model,'post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::find($id);
        return view("ContentManager::user.create",['model' => $model]);
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
        $model = User::find($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->description = $request->description;
        $model->photo = $request->photo;
        $model->save();
        return redirect(Admin::StrURL('contentManager/user'));
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
            User::destroy($tmp);   
        }else{
            User::destroy($id);  
        }
    }
}
