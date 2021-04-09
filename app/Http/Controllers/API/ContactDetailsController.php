<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\ContactDetailsRequest;
use App\Http\Resources\ContactDetailsCollection;
use App\Http\Resources\ContactDetailsResource;
use App\Models\ContactDetails;

class ContactDetailsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactDetails = ContactDetails::all();
        $contactDetails = new ContactDetailsCollection($contactDetails);

        return $this->sendResponse(trans('response.success_contact_details_index'), $contactDetails);
    }

    /**
     * @param \App\Http\Requests\ContactDetailsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactDetailsRequest $request)
    {
        ContactDetails::create($request->validated());

        return $this->sendResponse(trans('response.success_contact_details_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ContactDetails $contactDetail)
    {
        $contactDetails = new ContactDetailsResource($contactDetail);

        return $this->sendResponse(trans('response.success_contact_details_show'), $contactDetails);
    }

    /**
     * @param \App\Http\Requests\ContactDetailsRequest $request
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function update(ContactDetailsRequest $request, ContactDetails $contactDetail)
    {
        $contactDetail->update($request->validated());

        return $this->sendResponse(trans('response.success_contact_details_update'));
    }

    /**
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactDetails $contactDetail)
    {
        $contactDetail->delete();

        return $this->sendResponse(trans('response.success_contact_details_destroy'));
    }
}
