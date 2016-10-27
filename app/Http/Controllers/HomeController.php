<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Theme;
use App\Modules\ContentManager\Models\Articles;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Articles::where('post_type','post')->where('post_status','publish')->orderBy('id', 'desc')->paginate(10);
        return view(Theme::frontpage(),['blog'=>$blog]);
    }
}
