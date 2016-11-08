<?php

namespace App\Entities;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Roles
 * @package App\Entities
 * @version November 3, 2016, 2:34 am UTC
 */
class Roles extends Model
{
    use SoftDeletes;

    public $table = 'roles';
    
    public $timestamps = false;


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'type',
        'permission',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'type'=>'string',
        'permission'=>'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'type' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Entities\User::class);
    }
}
