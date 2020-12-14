<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StorePaymentType;
use App\Http\Requests\UpdatePaymentType;
use App\Http\Resources\PaymentTypeCollection;
use App\Http\Resources\PaymentType as PaymentTypeResource;
use App\PaymentType;
use App\Http\Controllers\API\BaseController as BaseController;

class PaymentTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_types = PaymentType::all();
        $payment_types = new PaymentTypeCollection($payment_types);

        return $this->sendResponse('Payment Types has been retrieved successfully.', $payment_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentType $request)
    {
        $validated = $request->validated();

        $payment_type = new PaymentType($validated);
        $payment_type->save();

        return $this->sendResponse('Payment Type has been created successfully.', null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_type = PaymentType::findOrFail($id);

        $payment_type =  new PaymentTypeResource($payment_type);

        return $this->sendResponse('Payment Type has been retrieved successfully.', $payment_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentType  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentType $request, $id)
    {
        $payment_type = PaymentType::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $payment_type[$key] = $value;
        }

        $payment_type->save();

        return $this->sendResponse('Payment Type has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_type = PaymentType::findOrFail($id);

        $payment_type->delete();

        return $this->sendResponse('Payment Type has been deleted successfully.');
    }

    public function lock($id)
    {
        $payment_type = PaymentType::findOrFail($id);

        if ($payment_type->status_id == "di") {
            $status = 'en';
            $message = "The payment_type has been enabled successfully.";
        } else {
            $status = 'di';
            $message = "The payment_type has been disabled successfully.";
        }

        $payment_type->status_id = $status;
        $payment_type->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
