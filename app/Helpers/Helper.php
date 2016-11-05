<?php 

namespace App\Helpers;
use Blade;
use Carbon\Carbon;
use App\Modules\ContentManager\Models\Options;
class Helper
{
    private $options;

    private $permission;

    public function __construct() {
        $this->options =  Options::all()->toArray();
    }

    public function menu($group = "main-menu")
    {
    	$menu = new Menu($group);        
        return $menu->generateMenu();
    }

    public function compress($soure,$destination){
        $com = new Compress($soure,$destination);
        return $com->run();
    }

    public function extract($soure,$destination){
        $com = new Compress($soure,$destination);
        return $com->extract();
    }

    public function widget($class,$option = []){
        $class = "App\\Widgets\\".str_replace(".", "\\", $class);
        $widget = new $class;
        return $widget->test();
    }

    public function taxonomyLink($taxonomy,$link = true){
        $res = [];
        if($link){
            foreach ($taxonomy as $value) {
                $res[] = '<a href="'.url("/category/".$value->slug).'">'.$value->name.'</a>';
            }
        }else{
            foreach ($taxonomy as $value) {
                $res[] = $value->name;
            }
        }
        return implode(",", $res);
    }

    public function bbcode($content){
        $bbcode = new BBCode();
        return $bbcode->toHTML($content);
    }

    public function option($keySearch){
        $result = null;
        foreach ($this->options as $value) {
            if($value['name'] == $keySearch){
                $result = $value['value'];
            }
        }
        return $result;
    }

    public function appTitle($title){
        return ($title == "") ? $this->option("site_title") : $title." - ".$this->option("site_title");
    }

    public function menuList(){
        return true;
    }

    private function permissionConfig($role = 'users'){
        $this->permission = null;
        if(in_array($role,array('administrator','editor'))){
            return $this->permission = config("permission.administrator");
        }
        return $this->permission = config("permission.users");
    }

    public function permissionList($role = null){
        $permissions = $this->permissionConfig($role);
        $permissionUI = $this->array2ul($permissions);
        echo '<pre>';
        echo $permissionUI;
        die;
        return $permissionUI;
    }

    public function array2ul($array) {
        $out = "<ul class='treeview-menu menu-open'>";
        foreach($array as $key => $elem){
            if(!is_array($elem)){
                $out .= "<li><span><input name='permission' type='checkbox' value='$key'/>$elem</span></li>";
            }
            else $out .= "<li><span><input name='permission' type='checkbox' value='$key'/></span>".$this->array2ul($elem)."</li>";
        }
        $out .= "</ul>";
        return $out;
    }
}