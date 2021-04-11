<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = new TagCollection(Tag::all());

        return $this->sendResponse(trans('response.success_tag_index'), $tags);
    }

    /**
     * @param \App\Http\Requests\TagStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        Tag::create($request->validated());

        return $this->sendResponse(trans('response.success_tag_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $tag = new TagResource($tag);

        return $this->sendResponse(trans('response.success_tag_show'), $tag);
    }

    /**
     * @param \App\Http\Requests\TagUpdateRequest $request
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return $this->sendResponse(trans('response.success_tag_update'));
    }

    /**
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return $this->sendResponse(trans('response.success_tag_destroy'));
    }
}
