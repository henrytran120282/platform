<?php

namespace App\Helpers;

use Blade;
use Carbon\Carbon;
use App\Modules\ContentManager\Models\Options;

class Helper
{
    private $options;

    private $permission;

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

    public function permissionList($role = null)
    {
        $permissionsList = config("permission.users");
        if (in_array($role, array('administrator', 'editor'))) {
            $permissionsList = config("permission.administrator");
        }
        $permissionUI = "<ul class='list-group'><li class='list-group-item'><input type='checkbox' id='fullaccess'> Allow All Access</li>";
        $permissionUI .= $this->passingToList($permissionsList);
        $permissionUI .= '</ul>';

        return $permissionUI;
    }

    public function passingToList($array)
    {
        $out = "<ul  class='list-group'>";
        foreach ($array as $key => $elem) {
            if (!is_array($elem)) {
                $fieldData = explode('@',$elem);
                $out .= "<li class='list-group-item'><input id='checkBoxChild' name='permission[{$fieldData[0]}][]' type='checkbox' value='{$fieldData[1]}'> " . (ucfirst($fieldData[1])) . "</li>";
            } else {
                $out .= "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#{$key}'> ".(ucfirst(str_replace('-', ' ', $key)))."  <span class='glyphicon glyphicon-plus'></span></button><div id='{$key}' class='collapse'>";
                $out .= "<li class='list-group-item'><input id='checkBoxParent' type='checkbox' value=''> All" . $this->passingToList($elem) . "</li></div>";
            }
        }
        $out .= "</ul>";
        return $out;
    }
}