<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'widgets';
    public $timestamps = false;

    public function getOptions($name){
    	$options = unserialize($this->options);
    	if(is_array($options)){
    		if(isset($options[$name])){
    			return $options[$name];
    		}else{
    			return null;	
    		}
    	}else{
    		return null;
    	}
    }
}
