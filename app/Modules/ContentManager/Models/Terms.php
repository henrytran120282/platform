<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $table = 'terms';
    protected $primaryKey = 'term_id';
    public $timestamps = false;
    protected $fillable = array('slug', 'name','taxonomy');

    public function children()
	{
	    return $this->hasMany('App\Modules\ContentManager\Models\Terms', 'parent', 'term_id');
	}

	public function parent()
	{
	    return $this->belongsTo('App\Modules\ContentManager\Models\Terms', 'parent');
	}

	private function termRelationships(){
        return $this->belongsToMany('App\Modules\ContentManager\Models\Articles', 'term_relationships','term_taxonomy_id','object_id');
    }

    public function posts(){
    	return $this->termRelationships()->where('post_status','publish')->where('post_type','post');
    }

    public function getUrl(){
    	return url('/'.$this->taxonomy)."/".$this->slug;
    }

	public function checkRelationPost($post_id){
		$count = TermRelationships::where("object_id",$post_id)->where("term_taxonomy_id",$this->term_id)->count();
		return ($count > 0) ? true : false ;
	}
}
