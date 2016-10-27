<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class TermRelationships extends Model
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'object_id';
    protected $fillable = array('term_taxonomy_id', 'object_id');
    public $timestamps = false;

    public function terms(){
    	return $this->belongsTo('App\Modules\ContentManager\Models\Terms', 'term_taxonomy_id','term_id');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Modules\ContentManager\Models\Articles', 'taggable');
    }

}
