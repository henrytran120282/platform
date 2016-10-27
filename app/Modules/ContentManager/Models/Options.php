<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'options';
    public $timestamps = false;
    protected $fillable = array('name','value');
}
