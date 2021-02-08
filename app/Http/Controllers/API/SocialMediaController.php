<?php

namespace App\Http\Controllers\API;

use App\SocialMedia;
use App\Http\Requests\StoreSocialMedia;
use App\Http\Requests\UpdateSocialMedia;
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
        $social_media = SocialMedia::all();
        $social_media = new SocialMediaCollection($social_media);

        return $this->sendResponse('Social Media has been retrieved successfully.', $social_media);
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

        return $this->sendResponse('Social Media has been created successfully.', null, BaseController::HTTP_CREATED);
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

        return $this->sendResponse('Social Media has been retrieved successfully.', $social_media);
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

        return $this->sendResponse('Social Media has been updated successfully.');
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

        return $this->sendResponse('Social Media has been deleted successfully.');
    }

    public function lock($id)
    {
        $social_media = SocialMedia::findOrFail($id);

        if ($social_media->status_id == "di") {
            $status = 'en';
            $message = "The social media has been enabled successfully.";
        } else {
            $status = 'di';
            $message = "The social media has been disabled successfully.";
        }

        $social_media->status_id = $status;
        $social_media->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
