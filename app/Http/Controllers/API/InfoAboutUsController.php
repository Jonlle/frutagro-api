<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\InfoAboutUsRequest;
use App\Http\Resources\InfoAboutUsCollection;
use App\Http\Resources\InfoAboutUsResource;
use App\Models\InfoAboutUs;

class InfoAboutUsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoAboutUs = !empty(request()->all()) ? InfoAboutUs::filter()->get() : InfoAboutUs::all();
        $infoAboutUs = new InfoAboutUsCollection($infoAboutUs);

        return $this->sendResponse(trans('response.success_information_index'), $infoAboutUs);
    }

    /**
     * @param \App\Http\Requests\InfoAboutUsRequest $request
     * @return \App\Http\Resources\InfoAboutUsResource
     */
    public function store(InfoAboutUsRequest $request)
    {
        $InfoAboutUs = InfoAboutUs::create($request->validated());

        return $this->sendResponse(trans('response.success_information_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\InfoAboutUs $InfoAboutU
     * @return \Illuminate\Http\Response
     */
    public function show(InfoAboutUs $InfoAboutU)
    {
        $InfoAboutUs = new InfoAboutUsResource($InfoAboutU);

        return $this->sendResponse(trans('response.success_information_show'), $InfoAboutUs);
    }

    /**
     * @param \App\Http\Requests\InfoAboutUsRequest $request
     * @param \App\Models\InfoAboutUs $InfoAboutU
     * @return \App\Http\Resources\InfoAboutUsResource
     */
    public function update(InfoAboutUsRequest $request, InfoAboutUs $InfoAboutU)
    {
        $InfoAboutU->update($request->validated());

        return $this->sendResponse(trans('response.success_information_update'));
    }

    /**
     * @param \App\InfoAboutUs $InfoAboutU
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoAboutUs $InfoAboutU)
    {
        $InfoAboutU->delete();

        return $this->sendResponse(trans('response.success_information_destroy'));
    }
}
