<?php 

namespace App\Widgets\defaultWidget;

use App\Entities\Galleries;
use App\Entities\GalleryImages;
use App\Widgets\BaseWidget;
use App\Modules\ContentManager\Models\Terms;
use App\Modules\ContentManager\Models\Articles;

class PostSlider extends BaseWidget
{
	public function __construct() {
    	$this->name = "Post Slider Widget";
        $this->description = 'This widget for show post slide show';
        $this->options = [
        	'title'=>'',
        	'type'=>'featured-post',
            'gallery_id'=>''
        ];
    }

    public function form(){
        $model = Terms::where("taxonomy","category")->get();
        $galleries = Galleries::all();

        return \View::make('widgets.defaultWidget.PostSlider.form',['options'=>$this->options,'model'=>$model, 'galleries'=>$galleries])->render();
    }

    public function run(){
        $idCat = $this->options['type'];
        switch ($idCat) {
            case 'featured-post':
                $model = Articles::whereHas('meta', function($q){
                    $q->where("meta_key","featured_post")->where("meta_value","on");
                })->where('post_status','publish')->get();
                break;

            case 'recent-post':
                $model = Articles::where('post_type','post')->where('post_status','publish')->orderby('id', 'desc')->get();
                break;

            case 'gallery':
                    $model = GalleryImages::where('gallery_id',$this->options['gallery_id'])->where('image_status',1)->orderby('id', 'desc')->get();
                break;

            default:
                $cat = Terms::find($idCat)->first();
                $model = $cat->posts;
                break;
        }
        return \View::make('widgets.defaultWidget.PostSlider.run',['model'=>$model,'options'=>$this->options])->render();
    }
}