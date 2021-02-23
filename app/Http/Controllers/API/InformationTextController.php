<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\InformationTextStoreRequest;
use App\Http\Requests\InformationTextUpdateRequest;
use App\Http\Resources\InformationTextCollection;
use App\Http\Resources\InformationTextResource;
use App\Models\InformationText;

class InformationTextController extends Controller
{
    /**
     * @return \App\Http\Resources\InformationTextCollection
     */
    public function index()
    {
        $informationTexts = new InformationTextCollection(InformationText::all());

        return $this->sendResponse(trans('response.success_information_text_index'), $informationTexts);
    }

    /**
     * @param \App\Http\Requests\InformationTextStoreRequest $request
     * @return \App\Http\Resources\InformationTextResource
     */
    public function store(InformationTextStoreRequest $request)
    {
        InformationText::create($request->validated());

        return $this->sendResponse(trans('response.success_information_text_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\InformationText $informationText
     * @return \App\Http\Resources\InformationTextResource
     */
    public function show(InformationText $informationText)
    {
        $informationText = new InformationTextResource($informationText);

        return $this->sendResponse(trans('response.success_information_text_show'), $informationText);
    }

    /**
     * @param \App\Http\Requests\InformationTextUpdateRequest $request
     * @param \App\Models\InformationText $informationText
     * @return \App\Http\Resources\InformationTextResource
     */
    public function update(InformationTextUpdateRequest $request, InformationText $informationText)
    {
        $informationText->update($request->validated());

        return $this->sendResponse(trans('response.success_information_text_update'));
    }

    /**
     * @param \App\Models\InformationText $informationText
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformationText $informationText)
    {
        $informationText->delete();

        return $this->sendResponse(trans('response.success_information_text_destroy'));
    }
}
