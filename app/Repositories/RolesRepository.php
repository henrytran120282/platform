<?php

namespace App\Repositories;

use App\Entities\Roles;
use InfyOm\Generator\Common\BaseRepository;

class RolesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Roles::class;
    }
}
