<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\OurServiceRequest;
use App\Http\Resources\OurServiceCollection;
use App\Http\Resources\OurServiceResource;
use App\Models\OurService;

class OurServiceController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourServices = OurService::all();
        $ourServices = new OurServiceCollection($ourServices);

        return $this->sendResponse(trans('response.success_service_index'), $ourServices);
    }

    /**
     * @param \App\Http\Requests\OurServiceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OurServiceRequest $request)
    {
        OurService::create($request->validated());

        return $this->sendResponse(trans('response.success_service_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\OurService $ourService
     * @return \Illuminate\Http\Response
     */
    public function show(OurService $ourService)
    {
        $ourService = new OurServiceResource($ourService);

        return $this->sendResponse(trans('response.success_service_show'), $ourService);
    }

    /**
     * @param \App\Http\Requests\OurServiceRequest $request
     * @param \App\Models\OurService $ourService
     * @return \Illuminate\Http\Response
     */
    public function update(OurServiceRequest $request, OurService $ourService)
    {
        $ourService->update($request->validated());

        return $this->sendResponse(trans('response.success_service_update'));
    }

    /**
     * @param \App\Models\OurService $ourService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurService $ourService)
    {
        $ourService->delete();

        return $this->sendResponse(trans('response.success_service_destroy'));
    }
}
