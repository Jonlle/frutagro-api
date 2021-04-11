<?php

namespace App\Http\Controllers\API;

use App\SocialMedia;
use App\Http\Requests\StoreSocialMedia;
use App\Http\Requests\UpdateSocialMedia;
use App\Http\Requests\UpsertSocialMedia;
use App\Http\Resources\SocialMediaCollection;
use App\Http\Resources\SocialMedia as SocialMediaResource;
use App\Http\Controllers\API\BaseController as BaseController;

class SocialMediaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social_media = !empty(request()->all()) ? SocialMedia::filter()->get() : SocialMedia::all();
        $social_media = new SocialMediaCollection($social_media);

        return $this->sendResponse(trans('response.success_social_media_index'), $social_media);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSocialMedia  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMedia $request)
    {
        $validated = $request->validated();

        $social_media = new SocialMedia($validated);
        $social_media->save();

        return $this->sendResponse(trans('response.success_social_media_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $social_media = SocialMedia::findOrFail($id);

        $social_media =  new SocialMediaResource($social_media);

        return $this->sendResponse(trans('response.success_social_media_show'), $social_media);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSocialMedia  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialMedia $request, $id)
    {
        $social_media = SocialMedia::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $social_media[$key] = $value;
        }

        $social_media->save();

        return $this->sendResponse(trans('response.success_social_media_update'));
    }

    /**
     * Update existing models or create new models.
     *
     * @param  UpdateSocialMedia  $request
     * @return \Illuminate\Http\Response
     */
    public function upsert(UpsertSocialMedia $request)
    {
        $validated = $request->validated();

        foreach ($validated['social_media'] as $social_media) {
            SocialMedia::updateOrCreate(
                ['name' => $social_media['name']],
                ['url' => $social_media['url'], 'status_id' => $social_media['status_id']]
            );
        }

        return $this->sendResponse(trans('response.success_social_media_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $social_media = SocialMedia::findOrFail($id);

        $social_media->delete();

        return $this->sendResponse(trans('response.success_social_media_destroy'));
    }

    public function lock($id)
    {
        $social_media = SocialMedia::findOrFail($id);

        if ($social_media->status_id == "di") {
            $status = 'en';
            $message = trans('response.success_social_media_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_social_media_lock');
        }

        $social_media->status_id = $status;
        $social_media->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
