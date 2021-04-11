<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
// use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        $error = new \stdClass();
        $error->code = $status = 500;
        $error->message = 'Internal Server Error.';

        switch (true) {
            case $exception instanceof ModelNotFoundException:
                $model = str_replace('App\\', '', $exception->getModel());
                $status = $error->code = 404;
                $error->message = "{$model} not found.";
                break;

            case $exception instanceof NotFoundHttpException:
                $error->code = $exception->getStatusCode();
                $error->message = 'Page not found.';

                break;

            case $exception instanceof AuthenticationException:
                $status = $error->code = 401;
                $error->message = $exception->getMessage();
                break;

            case $exception instanceof CustomException:
                $status = $error->code = 400;
                $error->message = $exception->getMessage();
                break;

            default:
                $error->code = method_exists($exception,'getStatusCode') ? $exception->getStatusCode() : $status;
                $error->message = method_exists($exception,'getMessage') ? $exception->getMessage() : $error->message;
                break;
        }

        $response = ['success' => false, 'error' => $error ];
        Log::debug('Exception: '.json_encode($error, JSON_UNESCAPED_UNICODE));

        return response()->json($response, $status);
    }
}
