<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreUser;
use App\Http\Requests\StoreCustomer;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;
use App\User;
use App\UserEmail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class AuthController extends BaseController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('login', 'register', 'registerAdmin');
    }

    public function register(StoreCustomer $request)
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

        $success['username'] = $user->username;

        return $this->sendResponse($success, 'User register successfully.', BaseController::HTTP_CREATED);
    }

    public function registerAdmin(StoreUser $request)
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

        $success['username'] = $user->username;

        return $this->sendResponse($success, 'User register successfully.', BaseController::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors(), BaseController::HTTP_UNPROCESSABLE_ENTITY);

        }

        $credentials = ['password' => $request->password];
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $user_email = UserEmail::where('email', $request->login)->first();
            $credentials['username'] = ($user_email) ? $user_email->user->username : '';
        } else {
            $credentials['username'] =  $request->login;
        }

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Frutagro_dist')->accessToken;
            $success['username'] =  $user->username;
            $success['role'] =  $user->role_id;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', [], BaseController::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>'User logout successfully'], 200);
    }

    public function user()
    {
        $user =  Auth::user();
        $success = new UserResource($user);

        return $this->sendResponse($success, 'User retrieved successfully.');
    }

}
