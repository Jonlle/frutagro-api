<?php

namespace App\Http\Controllers\API;

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

    /**
     * Send success response
     *
     * @param   string          $message
     * @param   resource        $result
     * @param   integer         $code
     */
    public function sendResponse($message, $result = null, $code = self::HTTP_OK)
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];

        if($result){
            $response['data'] = $result;
        }

        return response()->json($response, $code);
    }

    /**
     * Send error response
     *
     * @param   string          $message
     * @param   integer         $code
     * @param   object          $errors
     */
    public function sendError($message, $code = self::HTTP_NOT_FOUND, $errors = null)
    {
        $error = ($errors) ? $errors : new \stdClass() ;
        $error->code = $code;
        $error->message = $message;

        $response = [
            'success' => false,
            'error' => $error,
        ];

        return response()->json($response, $code);
    }
}
