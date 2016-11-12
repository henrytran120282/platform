<?php

namespace App\Helpers;

use Blade;
use Carbon\Carbon;
use App\Modules\ContentManager\Models\Options;

class Helper
{
    private $options;

    private $permissionAsigned;

    public function __construct()
    {
        $this->options = Options::all()->toArray();
    }

    public function menu($group = "main-menu")
    {
        $menu = new Menu($group);
        return $menu->generateMenu();
    }

    public function compress($soure, $destination)
    {
        $com = new Compress($soure, $destination);
        return $com->run();
    }

    public function extract($soure, $destination)
    {
        $com = new Compress($soure, $destination);
        return $com->extract();
    }

    public function widget($class, $option = [])
    {
        $class = "App\\Widgets\\" . str_replace(".", "\\", $class);
        $widget = new $class;
        return $widget->test();
    }

    public function taxonomyLink($taxonomy, $link = true)
    {
        $res = [];
        if ($link) {
            foreach ($taxonomy as $value) {
                $res[] = '<a href="' . url("/category/" . $value->slug) . '">' . $value->name . '</a>';
            }
        } else {
            foreach ($taxonomy as $value) {
                $res[] = $value->name;
            }
        }
        return implode(",", $res);
    }

    public function bbcode($content)
    {
        $bbcode = new BBCode();
        return $bbcode->toHTML($content);
    }

    public function option($keySearch)
    {
        $result = null;
        foreach ($this->options as $value) {
            if ($value['name'] == $keySearch) {
                $result = $value['value'];
            }
        }
        return $result;
    }

    public function appTitle($title)
    {
        return ($title == "") ? $this->option("site_title") : $title . " - " . $this->option("site_title");
    }

    public function menuList()
    {
        return true;
    }

    public function permissionList($role = 'administrator', $permissionAsigned)
    {
        $this->permissionAsigned = ($permissionAsigned != null)?\GuzzleHttp\json_decode($permissionAsigned):[];
        $permissionsList = config("permission");
        $permissionUI = "<ul class='list-group'><li class='list-group-item'><input type='checkbox' id='".$role."-role' name='fullaccess' value='".$role."'> Allow All Access</li>";
        $permissionUI .= $this->passingToList($permissionsList, $role);
        $permissionUI .= '</ul>';

        return $permissionUI;
    }

    public function passingToList($array, $role)
    {
        $permissionAsigned = [];
        if($this->permissionAsigned != null){
            $permissionAsigned = get_object_vars($this->permissionAsigned);
        }
        $out = "<ul  class='list-group'>";
        $assigned = '';
        foreach ($array as $key => $elem) {
            if (!is_array($elem)) {
                $fieldData = explode('@',$elem);
                $parentKey = $this->recursive_array_search($elem,$permissionAsigned);
                if($parentKey !== false){
                    $assigned = (array_key_exists($parentKey,$permissionAsigned) ? 'checked':'');
                }
                $out .= "<li class='list-group-item'><input id='checkBoxChild-{$role}' name='permission[{$fieldData[0]}][]' type='checkbox' value='{$elem}'  {$assigned}>". (ucfirst($fieldData[1])) . "</li>";
            } else {
                $out .= "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#{$key}'> ".(ucfirst(str_replace('-', ' ', $key)))."  <span class='glyphicon glyphicon-plus'></span></button><div id='{$key}' class='collapse'>";
                $out .= "<li class='list-group-item'>" . $this->passingToList($elem, $role) . "</li></div>";
            }
        }
        $out .= "</ul>";

        return $out;
    }

    public function recursive_array_search($needle,$haystack) {

        foreach($haystack as $key=>$value) {
            $current_key=$key;
            if($needle===$value OR (is_array($value) && $this->recursive_array_search($needle,$value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }
}