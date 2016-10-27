<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Menus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\User', 'post_author');
    }

    public function children(){
        $child = Menus::join('post_meta', 'posts.id', '=', 'post_meta.post_id')
                ->select('posts.*', 'post_meta.meta_key', 'post_meta.meta_value')
                ->where('post_meta.meta_key','_nav_item_parent')
                ->where('post_meta.meta_value',$this->id)
                ->orderBy('posts.menu_order', 'asc')
                ->get();
        return $child;    
    }

    public function getMetaValue($key){
        $model = ArticleMeta::where('post_id', $this->id)->where('meta_key', $key)->first();
        if(count($model) > 0){
            return $model->meta_value;
        }

        return null;
    }

    public function getURL(){
        $type = $this->getMetaValue("_nav_item_type");
        $res = "#";
        switch ($type) {
            case 'home':
                $res =  url('/');
                break;
            case 'category':
                $res = url('/category/'.$this->post_name);
                break;
            case 'custom':
                $res = $this->getMetaValue('_nav_item_url');
                break; 
            case 'page':
                $res = url('/'.$this->post_name.'.html');
                break;        
            
            default:
                $res = url('/'.$this->post_name);
                break;
        }
        return $res;
    }

}
