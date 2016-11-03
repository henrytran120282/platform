<?php

use App\Models\Roles;
use App\Repositories\RolesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesRepositoryTest extends TestCase
{
    use MakeRolesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RolesRepository
     */
    protected $rolesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->rolesRepo = App::make(RolesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRoles()
    {
        $roles = $this->fakeRolesData();
        $createdRoles = $this->rolesRepo->create($roles);
        $createdRoles = $createdRoles->toArray();
        $this->assertArrayHasKey('id', $createdRoles);
        $this->assertNotNull($createdRoles['id'], 'Created Roles must have id specified');
        $this->assertNotNull(Roles::find($createdRoles['id']), 'Roles with given id must be in DB');
        $this->assertModelData($roles, $createdRoles);
    }

    /**
     * @test read
     */
    public function testReadRoles()
    {
        $roles = $this->makeRoles();
        $dbRoles = $this->rolesRepo->find($roles->id);
        $dbRoles = $dbRoles->toArray();
        $this->assertModelData($roles->toArray(), $dbRoles);
    }

    /**
     * @test update
     */
    public function testUpdateRoles()
    {
        $roles = $this->makeRoles();
        $fakeRoles = $this->fakeRolesData();
        $updatedRoles = $this->rolesRepo->update($fakeRoles, $roles->id);
        $this->assertModelData($fakeRoles, $updatedRoles->toArray());
        $dbRoles = $this->rolesRepo->find($roles->id);
        $this->assertModelData($fakeRoles, $dbRoles->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRoles()
    {
        $roles = $this->makeRoles();
        $resp = $this->rolesRepo->delete($roles->id);
        $this->assertTrue($resp);
        $this->assertNull(Roles::find($roles->id), 'Roles should not exist in DB');
    }
}
