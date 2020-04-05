<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('register','login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:10',
            'doc_type_id' => 'required|max:3',
            'role_id' => 'required|max:6',
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

    public function login(Request $request)
    {
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

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>'User logout successfully'], 200);
    }

    public function user(){
        $user =  Auth::user();
        return $this->sendResponse($user, 'User retrieved successfully.');
    }

}
