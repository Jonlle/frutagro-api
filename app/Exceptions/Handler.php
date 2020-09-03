<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
// use Symfony\Component\HttpKernel\Exception\HttpException;
// use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $status = 500;
        $error = new \stdClass();
        $error->code = $status;
        $error->message = 'Internal Server Error.';

        switch (true) {
            case $exception instanceof ModelNotFoundException:
                $model = str_replace('App\\', '', $exception->getModel());
                $status = 404;
                $error->message = "{$model} not found.";
                break;

            // case $exception instanceof NotFoundHttpException:
            //     $error->message = 'Page not found.';
            //     // $status = $exception->getStatusCode();
            //     break;

            // case $exception instanceof MethodNotAllowedHttpException:
            //     $error->message = $exception->getMessage();
            //     // $status = $exception->getStatusCode();
            //     break;

            case $exception instanceof AuthenticationException:
                $status = 401;
                $error->message = $exception->getMessage();
                break;

            // case $exception instanceof HttpException:
            //     $error->message = $exception->getMessage();
            //     // $status = $exception->getStatusCode();
            //     break;

            case $exception instanceof QueryException:
                if (isset($exception->errorInfo) && isset($exception->errorInfo[1])) {
                    $errorInfo = explode(": ", $exception->getMessage());
                    $error->message = $errorInfo[1];
                    $error->sql = [
                        'code' => $exception->errorInfo[1],
                        'sql_state' => $exception->errorInfo[0]
                    ];
                }
                break;

            case $exception instanceof CustomException:
                $error->message = $exception->getMessage();
                $status = 400;
                break;

            default:
                // return parent::render($request, $exception);
                break;
        }

        $error->code = $status;
        $response = ['success' => false, 'error' => $error ];

        $exception_response = [
            'status_code' =>  method_exists($exception,'getStatusCode') ? $exception->getStatusCode() : $status,
            'message' =>  method_exists($exception,'getMessage') ? $exception->getMessage() : $error->message
        ];

        Log::debug('Exception: '.json_encode($exception_response, JSON_UNESCAPED_UNICODE));

        return response()->json($response, $status);
    }
}
