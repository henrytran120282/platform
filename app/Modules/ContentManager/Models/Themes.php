<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'themes';
    public $timestamps = false;

    public function meta()
    {
        return $this->hasMany('App\Modules\ContentManager\Models\ThemeMeta','theme_id');
    }

    public function metaOptions(){
        return $this->meta()->where("meta_group","options")->get();
    }
}
