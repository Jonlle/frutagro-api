<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{

    CONST HTTP_OK = Response::HTTP_OK;                                      // 200
    CONST HTTP_CREATED = Response::HTTP_CREATED;                            // 201
    CONST HTTP_NO_CONTENT = Response::HTTP_NO_CONTENT;                      // 204
    CONST HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;                    // 400
    CONST HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;                  // 401
    CONST HTTP_FORBIDDEN = Response::HTTP_FORBIDDEN;                        // 403
    CONST HTTP_NOT_FOUND = Response::HTTP_NOT_FOUND;                        // 404
    CONST HTTP_CONFLICT = Response::HTTP_CONFLICT;                          // 409
    CONST HTTP_UNPROCESSABLE_ENTITY = Response::HTTP_UNPROCESSABLE_ENTITY;  // 422

    public function sendResponse($result, $message, $code = self::HTTP_OK)
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];

        if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages, $code = self::HTTP_NOT_FOUND)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
