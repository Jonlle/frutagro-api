<?php

namespace App\Http\Controllers\API;

use App\User;
use App\UserAddress;
use App\Http\Requests\StoreAddress;
use App\Http\Requests\UpdateAddress;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\Address as AddressResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Log;

class CustomerAddressController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $customer
     * @return \Illuminate\Http\Response
     */
    public function index($customer)
    {
        $user = User::findOrFail($customer);

        if ($user->role_id != 3 && $user->role_id != 4) {
            return $this->sendError(trans('response.error_customer_not'), BaseController::HTTP_FORBIDDEN);
        }

        $addresses = new AddressCollection($user->user_addresses);

        return $this->sendResponse(trans('response.success_user_address_index'), $addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $customer
     * @param  StoreAddress  $request
     * @return \Illuminate\Http\Response
     */
    public function store($customer, StoreAddress $request)
    {
        $validated = $request->validated();

        $user = session('user');

        if (count($user->user_addresses) === 5) {
            return $this->sendError(trans('response.error_user_address_five_not'), BaseController::HTTP_CONFLICT);
        }

        $addresses = new UserAddress($validated);

        $user->user_addresses()->save($addresses);

        return $this->sendResponse(trans('response.success_user_address_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customer
     * @param  int  $address
     * @return \Illuminate\Http\Response
     */
    public function show($customer, $address)
    {
        $user = User::findOrFail($customer);

        if ($user->role_id != 3 && $user->role_id != 4) {
            return $this->sendError(trans('response.error_customer_not'), BaseController::HTTP_FORBIDDEN);
        }

        $address = UserAddress::findOrFail($address);

        if ($address->user_id != $user->id) {
            return $this->sendError(trans('response.error_user_address_not'));
        }

        $success = new AddressResource($address);

        return $this->sendResponse(trans('response.success_user_address_show'), $success);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $customer
     * @param  StoreAddress  $request
     * @param  int  $address
     * @return \Illuminate\Http\Response
     */
    public function update($customer, UpdateAddress $request, $address)
    {
        $validated = $request->validated();

        $address = session('address');

        foreach ($validated as $key => $value) {
            $address[$key] = $value;
        }

        $address->save();

        return $this->sendResponse(trans('response.success_user_address_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customer
     * @param  int  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer, $address)
    {
        $user = User::findOrFail($customer);

        if ($user->role_id != 3 && $user->role_id != 4) {
            return $this->sendError(trans('response.error_customer_not'), BaseController::HTTP_FORBIDDEN);
        }

        $address = UserAddress::findOrFail($address);

        if ($address->user_id != $user->id) {
            return $this->sendError(trans('response.error_user_address_not'));
        }

        $address->delete();

        return $this->sendResponse(trans('response.success_user_address_destroy'));
    }
}
