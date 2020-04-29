<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreRole;
use App\Http\Requests\UpdateRole;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\Role as RoleResource;
use App\Role;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        if(!$roles) {
            return $this->sendError('Roles no found.', []);
        }

        $success =  new RoleCollection($roles);

        return $this->sendResponse($success, 'Roles has been retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRole  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        $validated = $request->validated();

        $permissions = Arr::pull($validated, 'permissions');

        $role = new Role($validated);
        $role->save();
        $role->permissions()->attach($permissions);

        $success= new RoleResource($role);

        return $this->sendResponse($success, 'Role has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        if(!$role) {
            return $this->sendError('Role no found.', []);
        }

        $role =  new RoleResource($role);

        return $this->sendResponse($role, 'Role has been retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRole  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRole $request, $id)
    {
        $validated = $request->validated();

        $role = Role::find($id);

        if(!$role) {
            return $this->sendError('Role no found.', []);
        }

        $permissions = Arr::pull($validated, 'permissions');

        foreach ($validated as $key => $value) {
            $role[$key] = $value;
        }

        $role->save();
        $role->permissions()->sync($permissions);

        $success= new RoleResource($role);

        return $this->sendResponse($success, 'Role has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if(!$role) {
            return $this->sendError('Role no found.', []);
        }

        $role->delete();

        return $this->sendResponse([], 'Role has been deleted successfully.');
    }
}
