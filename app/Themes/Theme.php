<?php 

namespace App\Themes;
use File;
use App\Facades\Helper;
use App\Modules\ContentManager\Models\Themes;
use App\Modules\ContentManager\Models\ThemeMeta;
use App\Modules\ContentManager\Models\WidgetGroups;
class Theme
{
	protected $config;
	protected $defaulTmpPath;
	protected $copyPath;
    protected $activeName;
    protected $activeID;
    private $errors = [];
    private $requireConfigFile = [
                                    'name',
                                    'version',
                                    'author',
                                    'author_url',
                                    'description',
                                    'image_preview',
                                    'options',
                                    'widget_position',
                                    'menu_position'
                                    ];

	public function __construct() {
	   $this->config = config("theme");
	   $this->defaulTmpPath = [
    		"theme"=>app_path('Themes/tmp/theme'),
    		"widget"=>app_path('Themes/tmp/widget'),
            "widgetView"=>app_path('Themes/tmp/widgetView'),
    		"asset"=>app_path('Themes/tmp/asset')
    	];
        if($this->config['driver']=="file"){
            $this->activeName = $this->config['active'] ;
            $this->activeID = 1;
        }else{
            $active = Themes::where('status',true)->first();
            $this->activeName = $active->name;
            $this->activeID = $active->id;    
        }
    }

    public function getID(){
        return $this->activeID;
    }

    public function frontpage(){
        return $this->active().".frontpage";
    }

    public function strActive(){
        return $this->activeName;
    }

    public function active(){
        return "themes.".$this->activeName;
    }

    public function setCopyPath($name){
    	return $this->copyPath = [
    		"asset"=>public_path("themes/".$name),
    		"theme"=>resource_path('views/themes/'.$name),
            "widgetView"=>resource_path('views/widgets/'.$name),
    		"widget"=>app_path('Widgets/'.$name),
    	];
    }

    public function checkFileExist($path){
        return file_exists($path);
    }

    public function createThemeDir($name){
    	$copyPath = $this->setCopyPath($name);
    	foreach ($copyPath as $key => $value) {
    		File::makeDirectory($value);
    	}
    }

    public function checkFileConfig($name,$default = true){
        $pathFile = $this->setPathConfig($name,$default);
        if($this->checkFileExist($pathFile)){
            $file = include_once $pathFile;
            foreach ($this->requireConfigFile as $value) {
                if(!isset($file[$value])){
                    $this->errors[] = $value." Not found";
                }
            }
        }else{
            $this->errors[] = "config.php not found";
        }
    }

    public function getErrors(){
        return $this->errors;
    }

    public function error(){
        if(count($this->errors) > 0 ){
            return true;
        }

        return false;
    }

    public function install($name){
        $path = app_path('Themes/upload')."/".$name.".zip";
        if($this->checkFileExist($path)):
        	Helper::extract(app_path('Themes/tmp'),$path);
            $this->checkFileConfig($name,false);
            $this->insertToDB($name,false);
            if(!$this->error()){
                $copyPath = $this->setCopyPath($name);
                $this->createThemeDir($name);
                foreach ($this->defaulTmpPath as $key => $value) {
                    File::copyDirectory($value,$copyPath[$key]);
                }
            }
            $this->removeTmp();
        else:
            $this->errors[] = "file ".$name.".zip not found";
        endif;
    }

    public function uninstall($name){
    	$copyPath = $this->setCopyPath($name);
    	$file = app_path('Themes/upload')."/".$name.".zip";
    	foreach ($copyPath as $key => $value) {
    		if(File::isDirectory($value)){
    			File::deleteDirectory($value);
    		}
    	}
    	if(File::exists($file)){
			File::delete($file);
		}
        $this->deleteFromDB($name);
    }

    public function setCompress($name){
    	$this->removeTmp();
    	$copyPath = $this->setCopyPath($name);
    	foreach ($this->defaulTmpPath as $key => $value) {
    		File::makeDirectory($value);
    		File::copyDirectory($copyPath[$key], $value);
    	}
        $pathZip = app_path('Themes/upload')."/".$name.".zip";
        if(File::exists($pathZip)){
            File::delete($pathZip);
        }
    	Helper::compress(app_path('Themes/tmp'),$pathZip);
    	$this->removeTmp();
    }

    private function removeTmp(){
    	foreach ($this->defaulTmpPath as $key => $value) {
    		if(File::isDirectory($value)){
    			File::deleteDirectory($value);
    		}
    	}
    }

    public function option($key,$name,$defaulValue = ""){
       $tmp = ThemeMeta::where('theme_id',$this->activeID)->where('meta_group','options')->where('meta_key',$key)->first();
       $meta = unserialize($tmp->meta_value);
       $res = "";
       foreach ($meta as $value) {
           if($value['name'] == $name ){
                $res = $value['value'];         
                break;
           } 
       }
       return $res;
    }

    public function menu($group){
        $tmp =  ThemeMeta::where("theme_id",$this->getID())
        ->where("meta_group","menu_position")
        ->where("meta_key",$group)
        ->first();
        if(count($tmp) == 0 ){
            return null;
        }else{
            return Helper::menu($tmp->meta_value);
        }
    }

    private function setPathConfig($name,$default = true){
        if($default){
            $path = $this->setCopyPath($name);
        }else{
            $path = $this->defaulTmpPath;
        }
        return $path['theme']."/config.php";
    }

    public function insertToDB($name,$default = true){
        $pathFile = $this->setPathConfig($name,$default);
        if($this->checkFileExist($pathFile)){
            $file = include $pathFile;
            $this->deleteFromDB($name);
            $theme = new Themes();
            $theme->name = $file['name'];
            $theme->version = $file['version'];
            $theme->author = $file['author'];
            $theme->author_url = $file['author_url'];
            $theme->description = $file['description'];
            $theme->image_preview = $file['image_preview'];
            $theme->save();
            foreach ($file['widget_position'] as $value) {
                $group = new WidgetGroups();
                $group->theme_id = $theme->id;
                $group->name = $value;
                $group->save();
            }
            foreach ($file['menu_position'] as $value) {
                $meta = new ThemeMeta();
                $meta->theme_id = $theme->id;
                $meta->meta_group = "menu_position";
                $meta->meta_key = $value;
                $meta->meta_value = "";
                $meta->save();
            }
            foreach ($file['options'] as $key => $value) {
                $meta = new ThemeMeta();
                $meta->theme_id = $theme->id;
                $meta->meta_group = "options";
                $meta->meta_key = $key;
                $meta->meta_value = serialize($value);
                $meta->save();
            }
        }else{
            $this->errors[] = "config.php not found";
        }
    }

    private function deleteFromDB($name){
        Themes::where("name",$name)->delete();
    }

    private function setDataTheme(){

    }
}