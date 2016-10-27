<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'theme_meta';
    public $timestamps = false;

    public function getValue(){
    	$value = unserialize($this->meta_value);
    	return $value;
    }

}
