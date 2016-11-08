<?php

namespace App\Http\Controllers;

use App\Entities\Roles;
use App\Http\Requests\CreateRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Repositories\RolesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RolesController extends AppBaseController
{
    /** @var  RolesRepository */
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepo)
    {
        $this->rolesRepository = $rolesRepo;
    }

    /**
     * Display a listing of the Roles.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rolesRepository->pushCriteria(new RequestCriteria($request));
        $roles = $this->rolesRepository->all();

        return view('admin.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Roles.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function store(CreateRolesRequest $request)
    {
        $role = New Roles();

        $role->name = $request->name;
        $role->description = $request->description;
        $role->type = $request->type;
        $role->permission = (($request->permission != null)?\GuzzleHttp\json_encode($request->permission):null);
        $role->status = $request->status;
        $role->save();

        Flash::success('Roles saved successfully.');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified Roles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            Flash::error('Roles not found');

            return redirect(route('admin.roles.index'));
        }

        return view('admin.roles.show')->with('roles', $roles);
    }

    /**
     * Show the form for editing the specified Roles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            Flash::error('Roles not found');

            return redirect(route('admin.roles.index'));
        }

        return view('admin.roles.edit')->with('roles', $roles);
    }

    /**
     * Update the specified Roles in storage.
     *
     * @param  int              $id
     * @param UpdateRolesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRolesRequest $request)
    {
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            Flash::error('Roles not found');

            return redirect(route('admin.roles.index'));
        }
        $roles->name = $request->name;
        $roles->description = $request->description;
        $roles->type = $request->type;
        $roles->permission = (($request->permission != null)?\GuzzleHttp\json_encode($request->permission):null);
        $roles->status = $request->status;
        $roles->save();

//        $roles = $this->rolesRepository->update($request->all(), $id);

        Flash::success('Roles updated successfully.');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified Roles from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            Flash::error('Roles not found');

            return redirect(route('admin.roles.index'));
        }

        $this->rolesRepository->delete($id);

        Flash::success('Roles deleted successfully.');

        return redirect(route('admin.roles.index'));
    }
}
