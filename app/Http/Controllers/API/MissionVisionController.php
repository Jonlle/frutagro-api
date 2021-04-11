<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\MissionVisionStoreRequest;
use App\Http\Requests\MissionVisionUpdateRequest;
use App\Http\Resources\missionVisionResource;
use App\Models\InformationText;
use App\Models\Tag;

class MissionVisionController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informationTexts = !empty(request()->all()) ? InformationText::missionVision()->filter()->get() : InformationText::missionVision()->get();
        $informationTexts = missionVisionResource::collection($informationTexts);

        return $this->sendResponse(trans('response.success_information_text_index'), $informationTexts);
    }

    /**
     * @param \App\Http\Requests\MissionVisionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MissionVisionStoreRequest $request)
    {
        $validated = $request->validated();

        if (isset($validated['tags'])) {
            $tags = isset($validated['tags']) ? array_pop($validated) : [];
        }

        $mission_vission = InformationText::create($request->validated());

        foreach ($tags as $key => $value) {
            $tag = Tag::firstOrCreate(['tag' => $value]);
            $tag->information_texts()->attach($mission_vission->id);
        }

        return $this->sendResponse(trans('response.success_information_text_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\InformationText $informationText
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $informationText = InformationText::findOrFail($id);
        $informationText = new missionVisionResource($informationText);

        return $this->sendResponse(trans('response.success_information_text_show'), $informationText);
    }

    /**
     * @param \App\Http\Requests\MissionVisionUpdateRequest $request
     * @param \App\Models\InformationText $informationText
     * @return \Illuminate\Http\Response
     */
    public function update(MissionVisionUpdateRequest $request, InformationText $mission_vision)
    {
        $validated = $request->validated();

        if (isset($validated['tags'])) {
            $tags = isset($validated['tags']) ? array_pop($validated) : [];
        }

        $mission_vision->update($request->validated());
        $mission_vision->tags()->detach();

        foreach ($tags as $key => $value) {
            $tag = Tag::firstOrCreate(['tag' => $value]);
            $tag->information_texts()->attach($mission_vision->id);
        }

        return $this->sendResponse(trans('response.success_information_text_update'));
    }

    /**
     * @param \App\Models\InformationText $mission_vision
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformationText $mission_vision)
    {
        $mission_vision->delete();

        return $this->sendResponse(trans('response.success_information_text_destroy'));
    }
}
