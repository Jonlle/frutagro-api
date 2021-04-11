<?php

namespace App\Http\Controllers\API;

use App\DeliveryMethod;
use App\Http\Requests\StoreDeliveryMethod;
use App\Http\Requests\UpdateDeliveryMethod;
use App\Http\Resources\DeliveryMethodCollection;
use App\Http\Resources\DeliveryMethod as DeliveryMethodResource;
use App\Http\Controllers\API\BaseController as Controller;

class DeliveryMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_methods = !empty(request()->all()) ? DeliveryMethod::filter()->get() : DeliveryMethod::all();
        $delivery_methods = new DeliveryMethodCollection($delivery_methods);

        return $this->sendResponse(trans('response.success_delivery_method_index'), $delivery_methods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDeliveryMethod  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryMethod $request)
    {
        $validated = $request->validated();

        $delivery_method = new DeliveryMethod($validated);
        $delivery_method->save();

        return $this->sendResponse(trans('response.success_delivery_method_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery_method = DeliveryMethod::findOrFail($id);

        $delivery_method =  new DeliveryMethodResource($delivery_method);

        return $this->sendResponse(trans('response.success_delivery_method_show'), $delivery_method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDeliveryMethod  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryMethod $request, $id)
    {
        $delivery_method = DeliveryMethod::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $delivery_method[$key] = $value;
        }

        $delivery_method->save();

        return $this->sendResponse(trans('response.success_delivery_method_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery_method = DeliveryMethod::findOrFail($id);

        $delivery_method->delete();

        return $this->sendResponse(trans('response.success_delivery_method_destroy'));
    }

    public function status($id)
    {
        $delivery_method = DeliveryMethod::findOrFail($id);

        if ($delivery_method->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_delivery_method_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_delivery_method_lock');
        }

        $delivery_method->status_id = $status;
        $delivery_method->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }

    /**
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function setDefaultCurrency($id)
    {
        $delivery_method = DeliveryMethod::findOrFail($id);

        DeliveryMethod::where('default', 1)
            ->update(['default' => 0]);

        $delivery_method->update(['default' => 1]);

        return $this->sendResponse(trans('response.success_delivery_method_update'));
    }
}
