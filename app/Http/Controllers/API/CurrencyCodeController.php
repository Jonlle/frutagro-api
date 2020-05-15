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
        $currency_codes = new CurrencyCodeCollection(CurrencyCode::all());

        return $this->sendResponse($currency_codes, 'CurrencyCodes has been retrieved successfully.');
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

        $success = new CurrencyCodeResource($currency_code);

        return $this->sendResponse($success, 'CurrencyCode has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency_code = CurrencyCode::find($id);

        if(!$currency_code) {
            return $this->sendError('CurrencyCode no found.', []);
        }

        $currency_code =  new CurrencyCodeResource($currency_code);

        return $this->sendResponse($currency_code, 'CurrencyCode has been retrieved successfully.');
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
        $validated = $request->validated();

        $currency_code = CurrencyCode::find($id);

        if(!$currency_code) {
            return $this->sendError('CurrencyCode no found.', []);
        }

        foreach ($validated as $key => $value) {
            $currency_code[$key] = $value;
        }

        $currency_code->save();
        $success = new CurrencyCodeResource($currency_code);

        return $this->sendResponse($success, 'CurrencyCode has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency_code = CurrencyCode::find($id);

        if(!$currency_code) {
            return $this->sendError('CurrencyCode no found.', []);
        }

        $currency_code->delete();

        return $this->sendResponse([], 'CurrencyCode has been deleted successfully.');
    }
}
