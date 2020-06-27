<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\Permission as PermissionResource;
use App\Permission;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = new PermissionCollection(Permission::all());

        return $this->sendResponse($permissions, 'Permissions has been retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePermission  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermission $request)
    {
        $validated = $request->validated();

        $permission = new Permission($validated);
        $permission->save();

        $success = new PermissionResource($permission);

        return $this->sendResponse($success, 'Permission has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        $permission =  new PermissionResource($permission);

        return $this->sendResponse($permission, 'Permission has been retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePermission  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermission $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $permission[$key] = $value;
        }

        $permission->save();
        $success = new PermissionResource($permission);

        return $this->sendResponse($success, 'Permission has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if(!$permission) {
            return $this->sendError('Permission no found.', []);
        }

        $permission->delete();

        return $this->sendResponse([], 'Permission has been deleted successfully.');
    }
}
