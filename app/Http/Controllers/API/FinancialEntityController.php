<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreFinancialEntity;
use App\Http\Requests\UpdateFinancialEntity;
use App\Http\Resources\FinancialEntityCollection;
use App\Http\Resources\FinancialEntity as FinancialEntityResource;
use App\FinancialEntity;
use App\Http\Controllers\API\BaseController as BaseController;

class FinancialEntityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financial_entities = !empty(request()->all()) ? FinancialEntity::filter()->get() : FinancialEntity::all();
        $financial_entities = new FinancialEntityCollection($financial_entities);

        return $this->sendResponse(trans('response.success_financial_entity_index'), $financial_entities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFinancialEntity  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinancialEntity $request)
    {
        $validated = $request->validated();

        $financial_entity = new FinancialEntity($validated);
        $financial_entity->save();

        return $this->sendResponse(trans('response.success_financial_entity_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $financial_entity = FinancialEntity::findOrFail($id);
        $financial_entity = new FinancialEntityResource($financial_entity);

        return $this->sendResponse(trans('response.success_financial_entity_show'), $financial_entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFinancialEntity  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinancialEntity $request, $id)
    {
        $financial_entity = FinancialEntity::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $financial_entity[$key] = $value;
        }

        $financial_entity->save();

        return $this->sendResponse(trans('response.success_financial_entity_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $financial_entity = FinancialEntity::findOrFail($id);
        $financial_entity->delete();

        return $this->sendResponse(trans('response.success_financial_entity_destroy'));
    }

    public function lock($id)
    {
        $financial_entity = FinancialEntity::findOrFail($id);

        if ($financial_entity->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_financial_entity_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_financial_entity_lock');
        }

        $financial_entity->status_id = $status;
        $financial_entity->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
