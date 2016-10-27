<?php
namespace App\Helpers;

use App\Modules\ContentManager\Models\Menus;
use Illuminate\Http\Request;
class Menu{

	protected $model;
	protected $result;

	public function __construct($group = "main-menu") {
	    $this->model = Menus::join('post_meta', 'posts.id', '=', 'post_meta.post_id')
                ->where('post_meta.meta_key','_nav_item_parent')
                ->where('post_meta.meta_value','')
                ->where('posts.menu_group',$group)
                ->orderBy('posts.menu_order', 'asc')
                ->get();
    }

    public function generateMenu(){
    	foreach ($this->model as $value) {
        	$this->recursiveMenu($value,$value->children(),0)	;
        }  
        return $this->result;
    }

    private function recursiveMenu($model,$children,$i){
    	$i++;
    	$class = 'dropdown menu-item-has-children';
    	$caret = '<span class="caret"></span>';
		if($i > 1):
			$class = 'dropdown menu-item-has-children';
			$caret = '';
		endif;
    	if(count($children) >0){
            $caret = '<span class="caret"></span>';
    		$this->result .= '<li class="'.$class.' '.$this->classActive($model).'"><a href="'.$model->getURL().'" class="dropdown-toggle disabled " data-toggle="dropdown">'.$model->post_title.' '.$caret.'</a>';
			$this->result .=	'<ul class="sub-menu">';
				foreach ($children as $value) {
                	$this->recursiveMenu($value,$value->children(),$i);
                } 
			$this->result .= '</ul>';
			$this->result .= '</li>';
    	}else{
    		$this->result .= '<li class="'.$this->classActive($model).'"><a href="'.$model->getURL().'">'.$model->post_title.'</a></li>';
    	}
    }

    private function classActive($model){
        $request = request();
        $type = $model->getMetaValue("_nav_item_type");
        switch ($type) {
            case 'home':
                $res =  '/';
                break;
            case 'category':
                $res = 'category/'.$model->post_name;
                break;
            case 'custom':
                $res = $model->getMetaValue('_nav_item_url');
                break;
            case 'page':
                $res = $model->post_name.'.html';
                break;        
            
            default:
                $res = $model->post_name;
                break;
        }
        if($request->is($res)){
            return "active";
        }

        return "";
    }

}