<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\CarouselBannerRequest;
use App\Http\Resources\CarouselBannerCollection;
use App\Http\Resources\CarouselBannerResource;
use App\CarouselBanner;

class CarouselBannerController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carouselBanners = !empty(request()->all()) ? CarouselBanner::filter()->get() : CarouselBanner::all();
        $carouselBanners = new CarouselBannerCollection($carouselBanners);

        return $this->sendResponse(trans('response.success_banner_index'), $carouselBanners);
    }

    /**
     * @param \App\Http\Requests\CarouselBannerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarouselBannerRequest $request)
    {
        CarouselBanner::create($request->validated());

        return $this->sendResponse(trans('response.success_banner_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\CarouselBanner $carouselBanner
     * @return \Illuminate\Http\Response
     */
    public function show(CarouselBanner $carouselBanner)
    {
        $carouselBanner = new CarouselBannerResource($carouselBanner);

        return $this->sendResponse(trans('response.success_banner_show'), $carouselBanner);
    }

    /**
     * @param \App\Http\Requests\CarouselBannerRequest $request
     * @param \App\Models\CarouselBanner $carouselBanner
     * @return \Illuminate\Http\Response
     */
    public function update(CarouselBannerRequest $request, CarouselBanner $carouselBanner)
    {
        $carouselBanner->update($request->validated());

        return $this->sendResponse(trans('response.success_banner_update'));
    }

    /**
     * @param \App\Models\CarouselBanner $carouselBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarouselBanner $carouselBanner)
    {
        $carouselBanner->delete();

        return $this->sendResponse(trans('response.success_banner_destroy'));
    }

    public function status($id)
    {
        $carouselBanner = CarouselBanner::findOrFail($id);

        if ($carouselBanner->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_banner_enabled');
        } else {
            $status = 'di';
            $message = trans('response.success_banner_disabled');
        }

        $carouselBanner->status_id = $status;
        $carouselBanner->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
