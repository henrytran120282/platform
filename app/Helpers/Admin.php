<?php 

namespace App\Helpers;
use Blade;
use Carbon\Carbon;
class Admin
{
    private $prefixAdmin = "";

    public function __construct() {
        $this->prefixAdmin = config("module.backend");
    }

    public function route($name,$param = []){
        return route($this->prefixAdmin.".".$name,$param);
    }

    public function requestIs($route){
        return \Request::is($this->prefixAdmin."/".$route);
    }

    public function StrURL($url,$separator = "/"){
        return $this->prefixAdmin.$separator.$url;
    }

    public function theme(){
        return 'layouts.admin';   
    }

    public function widget($wid,$function = "form"){
        $tmp = $wid->class_name;
        $class = new $tmp();
        $class->init(unserialize($wid->options));
        if($function == "form"){
            return $class->form();
        }else{
            return $class->name;
        }
    }

    public function media(){
        $media = \App\Modules\ContentManager\Models\Articles::where('post_type','attachment')->where('post_mime_type','LIKE','%image%')->orderBy('id', 'desc')->paginate(6);
        $url = url("/")."/".$this->prefixAdmin."/contentManager/media/images";
        $media->setPath($url);
        return $media;
    }

    public function image($filename = null, $width = null, $height = null, $color = null){
        return new SimpleImage($filename = null, $width = null, $height = null, $color = null);
    }

    public function iconMedia($modelMedia){
        $mimeType = $modelMedia->post_mime_type;
        switch ($mimeType) {
            case 'image/jpeg':
            case 'image/png':
            case 'image/gif':
            case 'image/svg':
            case 'image/bmp':
                $res = '<img src="'.url("/uploads")."/".$modelMedia->post_name.'" class="img-responsive" />';
                break;
            
            default:
                $res = '<div style="width:100%;padding-top:30px;text-align:center"><i class="fa fa-file-o fa-5x"></i></div>' ;
                break;
        }
        return $res;
    }

    public function formatBytes($size = 0, $precision = 2){
        $surffixes = array('bytes','KB','MB','GB','TB');
        for($i = 0; $size > 1024; $i++){
            $size /= 1024;
        }

        return round($size,$precision)." ".$surffixes[$i];
    }

    public function listModule(){
        $modules = config("module.modules");
        unset($modules["ContentManager"]);
        return $modules;
    }

    public function userLog($id,$desc){
        $array['date'] = Carbon::now()->format('Y-m-d H:i:s');
        $array['desc'] = $desc;
        $metaUser = new \App\Modules\ContentManager\Models\UserMeta();
        $metaUser->user_id = $id;
        $metaUser->meta_key = 'user_log';
        $metaUser->meta_value = serialize($array);
        $metaUser->save();
    }

    public function userLogSerial($serial,$key){
        $tmp = unserialize($serial);
        return $tmp[$key];
    }
}