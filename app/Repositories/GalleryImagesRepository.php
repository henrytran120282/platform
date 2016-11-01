<?php

namespace App\Repositories;

use App\Entities\GalleryImages;
use InfyOm\Generator\Common\BaseRepository;

class GalleryImagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image_name',
        'image_title',
        'image_description',
        'gallery_id',
        'image_status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GalleryImages::class;
    }
}
