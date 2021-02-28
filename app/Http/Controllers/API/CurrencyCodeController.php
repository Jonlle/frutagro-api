<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCurrencyCode;
use App\Http\Requests\UpdateCurrencyCode;
use App\Http\Resources\CurrencyCodeCollection;
use App\Http\Resources\CurrencyCode as CurrencyCodeResource;
use App\CurrencyCode;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class CurrencyCodeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency_codes = !empty(request()->all()) ? CurrencyCode::filter()->get() : CurrencyCode::all();
        $currency_codes = new CurrencyCodeCollection($currency_codes);

        return $this->sendResponse(trans('response.success_currency_code_index'), $currency_codes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCurrencyCode  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrencyCode $request)
    {
        $validated = $request->validated();

        $currency_code = new CurrencyCode($validated);
        $currency_code->save();

        return $this->sendResponse(trans('response.success_currency_code_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency_code = CurrencyCode::findOrFail($id);

        $currency_code =  new CurrencyCodeResource($currency_code);

        return $this->sendResponse(trans('response.success_currency_code_show'), $currency_code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCurrencyCode  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencyCode $request, $id)
    {
        $currency_code = CurrencyCode::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $currency_code[$key] = $value;
        }

        $currency_code->save();
        $success = new CurrencyCodeResource($currency_code);

        return $this->sendResponse(trans('response.success_currency_code_update'), $success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency_code = CurrencyCode::findOrFail($id);

        $currency_code->delete();

        return $this->sendResponse(trans('response.success_currency_code_destroy'));
    }

    public function status($id)
    {
        $currency_code = CurrencyCode::findOrFail($id);

        if ($currency_code->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_currency_code_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_currency_code_lock');
        }

        $currency_code->status_id = $status;
        $currency_code->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }

    /**
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function setDefaultCurrency($id)
    {
        $currency_code = CurrencyCode::findOrFail($id);

        CurrencyCode::where('default', 1)
            ->update(['default' => 0]);

        $currency_code->update(['default' => 1]);

        return $this->sendResponse(trans('response.success_currency_code_update'));
    }
}
