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
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = new RoleCollection(Role::all());

        return $this->sendResponse('Roles has been retrieved successfully.', $roles);
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

        return $this->sendResponse('Role has been created successfully.', null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        $role =  new RoleResource($role);

        return $this->sendResponse('Role has been retrieved successfully.', $role);
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
        $role = Role::findOrFail($id);

        $validated = $request->validated();

        $permissions = Arr::pull($validated, 'permissions');

        foreach ($validated as $key => $value) {
            $role[$key] = $value;
        }

        $role->save();
        $role->permissions()->sync($permissions);

        $success= new RoleResource($role);

        return $this->sendResponse('Role has been updated successfully.', $success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return $this->sendResponse('Role has been deleted successfully.');
    }
}
