<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\ContentManager\Models\UserMeta;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $cast = [
        'is_admin' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function meta()
    {
        return $this->hasMany('App\Modules\ContentManager\Models\UserMeta','user_id');
    }
}
