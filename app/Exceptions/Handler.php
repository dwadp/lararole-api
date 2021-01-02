<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if( $request->wantsJson() && (!$exception instanceof ValidationException)) {
            $statusCode = $this->getStatusCode($exception);

            $response = $this->buildResponseMessage($statusCode, $exception);

            return response()->json($response, $statusCode);
        }

        return parent::render($request, $exception);
    }

    private function getStatusCode(Throwable $exception)
    {
        $methodExists = method_exists($exception, 'getStatusCode');

        if($methodExists) {
            return $exception->getStatusCode();
        }

        $propertyExists = property_exists($exception, 'statusCode');

        if($propertyExists) {
            return $exception->statusCode;
        }

        if($exception instanceof AuthenticationException) {
            return 401;
        }

        if($exception instanceof ModelNotFoundException) {
            return 404;
        }

        return 500;
    }

    private function buildResponseMessage($statusCode, Throwable $exception)
    {
        $messageExists = method_exists($exception, 'getMessage');

        if(!$messageExists) {
            return [
                'status' => false,
                'error' => [
                    'name' => $this->getStatusCodeTitle($statusCode),
                    'message' => 'Oops, something went wrong',
                    'code' => $statusCode,
                ],
            ];
        }

        return [
            'status' => false,
            'error' => [
                'name' => $this->getStatusCodeTitle($statusCode),
                'message' => $exception->getMessage(),
                'code' => $statusCode
            ],
        ];
    }

    private function getStatusCodeTitle($statusCode)
    {
        switch($statusCode) {
            case 400:
                return "Bad Request";
            case 401:
                return "Unauthorized";
            case 403:
                return "Access Forbidden";
            case 404:
                return "Not Found";
            case 405:
                return "Method Not Allowed";
            default:
                return "Internal Server Error";
        }
    }
}
