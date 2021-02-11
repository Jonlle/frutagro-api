<?php

namespace App\Http\Controllers\API;

use App\BankData;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\StoreBankData;
use App\Http\Requests\UpdateBankData;
use App\Http\Resources\BankDataCollection;
use App\Http\Resources\BankData as BankDataResource;

class BankDataController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_data = !empty(request()->all()) ? BankData::filter()->get() : BankData::all();
        $bank_data = new BankDataCollection($bank_data);

        return $this->sendResponse(trans('response.success_bank_data_index'), $bank_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBankData  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankData $request)
    {
        $validated = $request->validated();

        $bank_data = new BankData($validated);
        $bank_data->save();

        return $this->sendResponse(trans('response.success_bank_data_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank_data = BankData::findOrFail($id);

        $bank_data =  new BankDataResource($bank_data);

        return $this->sendResponse(trans('response.success_bank_data_show'), $bank_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBankData  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankData $request, $id)
    {
        $bank_data = BankData::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $bank_data[$key] = $value;
        }

        $bank_data->save();

        return $this->sendResponse(trans('response.success_bank_data_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank_data = BankData::findOrFail($id);

        $bank_data->delete();

        return $this->sendResponse(trans('response.success_bank_data_destroy'));
    }

    public function lock($id)
    {
        $bank_data = BankData::findOrFail($id);

        if ($bank_data->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_bank_data_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_bank_data_lock');
        }

        $bank_data->status_id = $status;
        $bank_data->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
