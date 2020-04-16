<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreUser;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;
use App\User;
use App\UserEmail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('register','login','registerAdmin','loginAdmin');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:10',
            'doc_type_id' => 'required|max:3',
            'role_id' => 'required|max:8',
            'status_id' => 'required|max:2',
            'first_name' => 'required',
            'last_name' => 'required',
            'document' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error.', $validator->errors(), BaseController::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (User::firstWhere('username', $request->username)) {
            return $this->sendError('A user with this username already exists.', [], BaseController::HTTP_CONFLICT);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $success =  $user;

        return $this->sendResponse($success, 'User register successfully.', BaseController::HTTP_CREATED);
    }

    public function registerAdmin(StoreUser $request)
    {
        $validated = $request->validated();

        $user_email = new UserEmail([
            'email' => $request['email'],
            'status_id'=> '1',
            'principal' => '1'
        ]);

        $data = Arr::except($validated, ['email']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->user_emails()->save($user_email);

        $success['username'] = $user->username;

        return $this->sendResponse($success, 'User register successfully.', BaseController::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error.', $validator->errors(), BaseController::HTTP_UNPROCESSABLE_ENTITY);

        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
        $user = Auth::user();
        $success['token'] = $user->createToken('Frutagro_dist')->accessToken;
        $success['username'] =  $user->username;

        return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', [], BaseController::HTTP_UNAUTHORIZED);
        }
    }

    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors(), BaseController::HTTP_UNPROCESSABLE_ENTITY);

        }

        $credentials = ['password' => $request->password];
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        Log::debug('fieldType: '.json_encode($fieldType));
        if ($fieldType == 'email') {
            $user_email = UserEmail::where('email', $request->username)->first();
            $credentials['id'] = $user_email->user_id;
        } else {
            $credentials['username'] =  $request->username;
        }

        if (auth()->attempt($credentials)) {
        $user = Auth::user();
        $success['token'] = $user->createToken('Frutagro_dist')->accessToken;
        $success['username'] =  $user->username;

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

    public function logoutAdmin(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>'User logout successfully'], 200);
    }

    public function user(){
        $user =  Auth::user();
        $user_emails = $user->user_emails->where('principal', '1')->first();
        $success = Arr::add($user, 'email', $user_emails, 'status', $user->status);
        $success = new UserResource($success);

        return $this->sendResponse($success, 'User retrieved successfully.');
    }

}
