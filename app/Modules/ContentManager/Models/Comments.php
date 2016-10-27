<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = array('author','post_id', 'email','content','approved','url','parent');

    public function post()
    {
        return $this->belongsTo('App\Modules\ContentManager\Models\Articles', 'post_id');
    }

    public function getAvatar(){
    	if($this->user_id != 0){
    		return $this->user()->photo;
    	}

    	return url('/assets/images/default-user.png');
    }

    public function user(){
    	if($this->user_id != 0){
    		return $this->belongsTo('App\Users','user_id');
    	}
    	
    	return null;
    }
}
