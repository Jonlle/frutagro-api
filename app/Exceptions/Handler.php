<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        $response = ['success' => false, 'message' => ''];
        $status = 404;
        switch (true) {
            case $exception instanceof ModelNotFoundException:
                $model = str_replace('App\\', '', $exception->getModel());
                $response['message'] = "{$model} not found.";
                break;

            case $exception instanceof NotFoundHttpException:
                $response['message'] = 'Page not found.';
                $status = $exception->getStatusCode();
                break;

            case $exception instanceof MethodNotAllowedHttpException:
                $response['message'] = $exception->getMessage();
                $status = $exception->getStatusCode();
                break;

            case $exception instanceof AuthenticationException:
                $response['message'] = $exception->getMessage();
                $status = 401;
                break;

            case $exception instanceof HttpException:
                $response['message'] = $exception->getMessage();
                $status = $exception->getStatusCode();
                break;

            case $exception instanceof QueryException:
                Log::debug('QueryException: '.json_encode($exception->getMessage(), JSON_UNESCAPED_UNICODE));
                $status = 500;

                if (isset($exception->errorInfo) && isset($exception->errorInfo[1])) {
                    $errorInfo = explode(": ", $exception->getMessage());
                    $response['message'] = $errorInfo[1];
                    $response['error'] = [
                        'code' => $exception->errorInfo[1],
                        'sql_state' => $exception->errorInfo[0]
                    ];
                } else {
                    $response['message'] = 'Internal Server Error.';
                }
                break;

            case $exception instanceof CustomException:
                $response['message'] = $exception->getMessage();
                $status = 400;
                break;

            default:
                if ($exception->getMessage() !== null)
                    Log::debug('Exception: '.json_encode($exception->getMessage(), JSON_UNESCAPED_UNICODE));

                return parent::render($request, $exception);
                break;
        }

        return response()->json($response, $status);
    }
}
