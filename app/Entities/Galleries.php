<?php

namespace App\Entities;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Galleries
 * @package App\Entities
 * @version November 1, 2016, 7:44 am UTC
 */
class Galleries extends Model
{
    use SoftDeletes;

    public $table = 'galleries';
    
    public $timestamps = false;


    protected $dates = ['deleted_at'];


    public $fillable = [
        'gallery_name',
        'gallery_status',
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
        'gallery_name' => 'string',
        'gallery_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function galleryImages()
    {
        return $this->hasMany(\App\Entities\GalleryImage::class);
    }
}
