<?php

namespace App\Http\Controllers\API;

use App\User;
use App\UserEmail;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = new UserCollection(
            User::whereIn('role_id', [1, 2])
                ->get()
        );

        return $this->sendResponse(trans('response.success_admin_index'), $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $validated = $request->validated();

        $user_email = new UserEmail([
            'email' => $request['email'],
            'status_id' => 'ac',
            'principal' => '1'
        ]);

        $data = Arr::except($validated, ['email']);
        $data['password'] = Hash::make($data['password']);

        $user = new User($data);
        $user->save();
        $user->user_emails()->save($user_email);

        return $this->sendResponse(trans('response.success_admin_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id != 1 && $user->role_id != 2) {
            return $this->sendError(trans('response.error_admin_not'), BaseController::HTTP_FORBIDDEN);
        }

        $user = new UserResource($user);

        return $this->sendResponse(trans('response.success_admin_show'), $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id != 1 && $user->role_id != 2) {
            return $this->sendError(trans('response.error_admin_not'), BaseController::HTTP_FORBIDDEN);
        }

        $validated = $request->validated();

        $email = Arr::pull($validated, 'email');
        $user_email = $user->user_emails()->first();
        $user_email['email'] = $email;
        $user_email->save();

        foreach ($validated as $key => $value) {
            $user[$key] = $value;
        }

        $user->save();

        return $this->sendResponse(trans('response.success_admin_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->sendResponse(trans('response.success_admin_destroy'));
    }

    public function lock($id)
    {
        $user = User::findOrFail($id);

        if ($user->status_id == "in") {
            $status = 'ac';
            $message = trans('response.success_admin_unlock');
        } else {
            $status = 'in';
            $message = trans('response.success_admin_lock');
        }

        $user->status_id = $status;
        $user->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
