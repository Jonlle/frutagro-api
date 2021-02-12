<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreSupplier;
use App\Http\Requests\UpdateSupplier;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\Supplier as SupplierResource;
use App\Supplier;
use App\Http\Controllers\API\BaseController as BaseController;

class SupplierController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = new SupplierCollection(Supplier::all());

        return $this->sendResponse(trans('response.success_supplier_index'), $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupplier  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier $request)
    {
        $validated = $request->validated();

        $supplier = new Supplier($validated);
        $supplier->save();

        return $this->sendResponse(trans('response.success_supplier_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier =  new SupplierResource($supplier);

        return $this->sendResponse(trans('response.success_supplier_show'), $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSupplier  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplier $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $supplier[$key] = $value;
        }

        $supplier->save();

        return $this->sendResponse(trans('response.success_supplier_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return $this->sendResponse(trans('response.success_supplier_destroy'));
    }

    public function lock($id)
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_supplier_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_supplier_lock');
        }

        $supplier->status_id = $status;
        $supplier->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
