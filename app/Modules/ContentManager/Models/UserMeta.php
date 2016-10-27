<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = 'user_meta';
    protected $primaryKey = 'meta_id';
    public $timestamps = false;    
}
