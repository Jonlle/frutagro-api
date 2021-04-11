<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\GeneralBannerStoreRequest;
use App\Http\Requests\GeneralBannerUpdateRequest;
use App\Http\Resources\GeneralBannerCollection;
use App\Http\Resources\GeneralBannerResource;
use App\Models\GeneralBanner;

class GeneralBannerController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generalBanners = !empty(request()->all()) ? GeneralBanner::filter()->get() : GeneralBanner::all();
        $generalBanners = new GeneralBannerCollection($generalBanners);

        return $this->sendResponse(trans('response.success_banner_index'), $generalBanners);
    }

    /**
     * @param \App\Http\Requests\GeneralBannerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneralBannerStoreRequest $request)
    {
        GeneralBanner::create($request->validated());

        return $this->sendResponse(trans('response.success_banner_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\GeneralBanner $generalBanner
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralBanner $generalBanner)
    {
        $generalBanner = new GeneralBannerResource($generalBanner);

        return $this->sendResponse(trans('response.success_banner_show'), $generalBanner);
    }

    /**
     * @param \App\Http\Requests\GeneralBannerUpdateRequest $request
     * @param \App\Models\GeneralBanner $generalBanner
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralBannerUpdateRequest $request, GeneralBanner $generalBanner)
    {
        $generalBanner->update($request->validated());

        return $this->sendResponse(trans('response.success_banner_update'));
    }

    /**
     * @param \App\Models\GeneralBanner $generalBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralBanner $generalBanner)
    {
        $generalBanner->delete();

        return $this->sendResponse(trans('response.success_banner_destroy'));
    }
}
