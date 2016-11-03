<?php

namespace App\Entities;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GalleryImages
 * @package App\Entities
 * @version November 1, 2016, 7:46 am UTC
 */
class GalleryImages extends Model
{
    use SoftDeletes;

    public $table = 'gallery_images';
    
    public $timestamps = false;


    protected $dates = ['deleted_at'];


    public $fillable = [
        'image_name',
        'image_title',
        'image_description',
        'image_link',
        'gallery_id',
        'image_status',
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
        'image_name' => 'string',
        'image_title' => 'string',
        'image_description' => 'string',
        'image_link' => 'string',
        'gallery_id' => 'integer',
        'image_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function gallery()
    {
        return $this->belongsTo(\App\Entities\Galleries::class);
    }
}
