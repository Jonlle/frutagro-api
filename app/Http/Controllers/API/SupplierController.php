<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreSupplier;
use App\Http\Requests\UpdateSupplier;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\Supplier as SupplierResource;
use App\Supplier;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

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

        return $this->sendResponse($suppliers, 'Suppliers has been retrieved successfully.');
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

        return $this->sendResponse([], 'Supplier has been created successfully.', BaseController::HTTP_CREATED);
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

        return $this->sendResponse($supplier, 'Supplier has been retrieved successfully.');
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

        return $this->sendResponse([], 'Supplier has been updated successfully.');
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

        return $this->sendResponse([], 'Supplier has been deleted successfully.');
    }

    public function lock($id)
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->status_id == "di") {
            $status = 'en';
            $message = "The supplier has been enabled successfully.";
        } else {
            $status = 'di';
            $message = "The supplier has been disabled successfully.";
        }

        $supplier->status_id = $status;
        $supplier->save();

        $succes['status'] = $status;

        return $this->sendResponse($succes, $message);
    }
}
