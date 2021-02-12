<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreAdminPaymentMethod;
use App\Http\Requests\UpdateAdminPaymentMethod;
use App\Http\Resources\AdminPaymentMethodCollection;
use App\Http\Resources\AdminPaymentMethod as AdminPaymentMethodResource;
use App\AdminPaymentMethod;
use App\Http\Controllers\API\BaseController as BaseController;

class AdminPaymentMethodController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adm_pay_methods = !empty(request()->all()) ? AdminPaymentMethod::filter()->get() : AdminPaymentMethod::all();
        $adm_pay_methods = new AdminPaymentMethodCollection($adm_pay_methods);

        return $this->sendResponse(trans('response.success_admin_pay_method_index'), $adm_pay_methods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAdminPaymentMethod  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminPaymentMethod $request)
    {
        $validated = $request->validated();

        $adm_pay_method = new AdminPaymentMethod($validated);
        $adm_pay_method->save();

        return $this->sendResponse(trans('response.success_admin_pay_method_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adm_pay_method = AdminPaymentMethod::findOrFail($id);

        $adm_pay_method =  new AdminPaymentMethodResource($adm_pay_method);

        return $this->sendResponse(trans('response.success_admin_pay_method_show'), $adm_pay_method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAdminPaymentMethod  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminPaymentMethod $request, $id)
    {
        $adm_pay_method = AdminPaymentMethod::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $adm_pay_method[$key] = $value;
        }

        $adm_pay_method->save();

        return $this->sendResponse(trans('response.success_admin_pay_method_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adm_pay_method = AdminPaymentMethod::findOrFail($id);

        $adm_pay_method->delete();

        return $this->sendResponse(trans('response.success_admin_pay_method_destroy'));
    }

    public function lock($id)
    {
        $adm_pay_method = AdminPaymentMethod::findOrFail($id);

        if ($adm_pay_method->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_admin_pay_method_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_admin_pay_method_lock');
        }

        $adm_pay_method->status_id = $status;
        $adm_pay_method->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
