<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesApiTest extends TestCase
{
    use MakeRolesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRoles()
    {
        $roles = $this->fakeRolesData();
        $this->json('POST', '/api/v1/roles', $roles);

        $this->assertApiResponse($roles);
    }

    /**
     * @test
     */
    public function testReadRoles()
    {
        $roles = $this->makeRoles();
        $this->json('GET', '/api/v1/roles/'.$roles->id);

        $this->assertApiResponse($roles->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRoles()
    {
        $roles = $this->makeRoles();
        $editedRoles = $this->fakeRolesData();

        $this->json('PUT', '/api/v1/roles/'.$roles->id, $editedRoles);

        $this->assertApiResponse($editedRoles);
    }

    /**
     * @test
     */
    public function testDeleteRoles()
    {
        $roles = $this->makeRoles();
        $this->json('DELETE', '/api/v1/roles/'.$roles->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/roles/'.$roles->id);

        $this->assertResponseStatus(404);
    }
}
