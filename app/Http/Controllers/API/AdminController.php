<?php

namespace App\Http\Controllers\API;

use App\User;
use App\UserEmail;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Validator;

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
            User::whereIn('role_id', ['owner', 'admin'])
                ->get()
        );

        return $this->sendResponse($users, 'Users has been retrieved successfully.');
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

        return $this->sendResponse([], 'User has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendError('User no found.', []);
        }

        if ($user->role_id != 'owner' && $user->role_id != 'admin') {
            return $this->sendError('User is not an admin.', []);
        }

        $user = new UserResource($user);

        return $this->sendResponse($user, 'User has been retrieved successfully.');
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
        $user = User::find($id);

        if (!$user) {
            return $this->sendError('User no found.', []);
        }

        if ($user->role_id != 'owner' && $user->role_id != 'admin') {
            return $this->sendError('User is not an admin.', []);
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

        return $this->sendResponse([], 'User has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendError('User no found.', []);
        }

        $user->delete();

        return $this->sendResponse([], 'User has been deleted successfully.');
    }
}