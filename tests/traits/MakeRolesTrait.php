<?php

use Faker\Factory as Faker;
use App\Entities\Roles;
use App\Repositories\RolesRepository;

trait MakeRolesTrait
{
    /**
     * Create fake instance of Roles and save it in database
     *
     * @param array $rolesFields
     * @return Roles
     */
    public function makeRoles($rolesFields = [])
    {
        /** @var RolesRepository $rolesRepo */
        $rolesRepo = App::make(RolesRepository::class);
        $theme = $this->fakeRolesData($rolesFields);
        return $rolesRepo->create($theme);
    }

    /**
     * Get fake instance of Roles
     *
     * @param array $rolesFields
     * @return Roles
     */
    public function fakeRoles($rolesFields = [])
    {
        return new Roles($this->fakeRolesData($rolesFields));
    }

    /**
     * Get fake data of Roles
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRolesData($rolesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'status' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $rolesFields);
    }
}
