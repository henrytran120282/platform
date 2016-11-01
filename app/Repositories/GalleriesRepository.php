<?php

namespace App\Repositories;

use App\Entities\Galleries;
use InfyOm\Generator\Common\BaseRepository;

class GalleriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gallery_name',
        'gallery_status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Galleries::class;
    }
}
