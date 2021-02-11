<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\Permission as PermissionResource;
use App\Permission;
use App\Http\Controllers\API\BaseController as BaseController;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = !empty(request()->all()) ? Permission::filter()->get() : Permission::all();
        $permissions = new PermissionCollection($permissions);

        return $this->sendResponse(trans('response.success_permission_index'), $permissions);
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

        return $this->sendResponse(trans('response.success_permission_store'), null, BaseController::HTTP_CREATED);
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

        return $this->sendResponse(trans('response.success_permission_show'), $permission);
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

        return $this->sendResponse(trans('response.success_permission_update'), $success);
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

        $permission->delete();

        return $this->sendResponse(trans('response.success_permission_destroy'));
    }
}
