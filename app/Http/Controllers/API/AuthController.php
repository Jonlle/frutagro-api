<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreUser;
use App\Http\Requests\StoreCustomer;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserAuth as UserResource;
use App\User;
use App\UserEmail;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'email' => 'required|string',
            'password' => 'required|max:12',
            'remember_me' => 'boolean'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors(), BaseController::HTTP_UNPROCESSABLE_ENTITY);

        }

        $credentials = ['password' => $request->password];
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $user_email = UserEmail::where('email', $request->email)->first();
            $credentials['username'] = ($user_email) ? $user_email->user->username : '';
        } else {
            $credentials['username'] =  $request->email;
        }

        if (Auth::attempt($credentials, $request->remember_me)) {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = now()->addYears(5);
            $token->save();
            $success['username'] = $user->username;
            $success['access_token'] = $tokenResult->accessToken;
            $success['token_type'] = 'Bearer';
            $success['expires_at'] = Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString();

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', [], BaseController::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendResponse([], 'User logout successfully.');
    }

    public function user()
    {
        $user = Auth::user();
        $success = new UserResource($user);

        return $this->sendResponse($success, 'User retrieved successfully.');
    }

    public function updateRememberToken(Request $request)
    {
        $user = Auth::user();
        $user->setRememberToken($request->remember_token);

        $timestamps = $user->timestamps;

        $user->timestamps = false;
        $user->save();
        $user->timestamps = $timestamps;

        return $this->sendResponse([], 'Remember token has been updated successfully.');
    }
}
