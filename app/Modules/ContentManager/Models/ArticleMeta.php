<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleMeta extends Model
{
    protected $table = 'post_meta';
    protected $primaryKey = 'meta_id';
    public $timestamps = false;
    protected $fillable = array('post_id', 'meta_key','meta_value');
}
