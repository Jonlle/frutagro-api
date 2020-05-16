<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\Customer as CustomerResource;
use App\User;
use App\UserEmail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  new CustomerCollection(
            User::whereIn('role_id', ['person', 'business'])
                ->get()
        );

        return $this->sendResponse($users, 'Users has been retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomer  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        $validated = $request->validated();

        $user_email = new UserEmail([
            'email' => $request['email'],
            'status_id' => 'a',
            'principal' => '1'
        ]);

        $data = Arr::except($validated, ['email']);
        $data['password'] = bcrypt($data['password']);

        $user = new User($data);
        $user->save();
        $user->user_emails()->save($user_email);

        $success['username'] = $user->username;

        return $this->sendResponse($success, 'User has been created successfully.', BaseController::HTTP_CREATED);
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

        if(!$user) {
            return $this->sendError('User no found.', []);
        }

        $user =  new CustomerResource($user);

        return $this->sendResponse($user, 'User has been retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomer  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer $request, $id)
    {
        $validated = $request->validated();

        $user = User::find($id);

        if(!$user) {
            return $this->sendError('User no found.', []);
        }

        $email = Arr::pull($validated, 'email');
        $user_email = $user->user_emails()->first();
        $user_email['email'] = $email;
        $user_email->save();

        foreach ($validated as $key => $value) {
            $user[$key] = $value;
        }

        $user->save();
        $success = new CustomerResource($user);

        return $this->sendResponse($success, 'User has been updated successfully.');
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

        if(!$user) {
            return $this->sendError('User no found.', []);
        }

        $user->delete();

        return $this->sendResponse([], 'User has been deleted successfully.');
    }
}
