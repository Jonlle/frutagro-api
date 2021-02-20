<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\LogoFavicon;
use App\Http\Requests\StoreLogoFavicon;
use App\Http\Requests\UpdateLogoFavicon;
use App\Http\Resources\LogoFaviconCollection;
use App\Http\Resources\LogoFavicon as LogoFaviconResource;

class LogoFaviconController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo_favicon = new LogoFaviconCollection(LogoFavicon::all());

        return $this->sendResponse(trans('response.success_logo_favicon_index'), $logo_favicon);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLogoFavicon  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogoFavicon $request)
    {
        $validated = $request->validated();

        $logo_favicon = new LogoFavicon($validated);
        $logo_favicon->save();

        return $this->sendResponse(trans('response.success_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logo_favicon = LogoFavicon::findOrFail($id);
        $logo_favicon =  new LogoFaviconResource($logo_favicon);

        return $this->sendResponse(trans('response.success_show'), $logo_favicon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLogoFavicon  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogoFavicon $request, $id)
    {
        $logo_favicon = LogoFavicon::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $logo_favicon[$key] = $value;
        }

        $logo_favicon->save();

        return $this->sendResponse(trans('response.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logo_favicon = LogoFavicon::findOrFail($id);

        $logo_favicon->delete();

        return $this->sendResponse(trans('response.success_destroy'));
    }
}
