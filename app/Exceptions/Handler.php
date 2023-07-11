<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Auth\AuthenticationException;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            $request->headers->set('Accept', "application/json");
            if ($exception instanceof ThrottleRequestsException) {
                return app_response([], __('auth.throttle', ['seconds' => $exception->getHeaders()["Retry-After"]]), Response::HTTP_UNAUTHORIZED);
            }
            if (!empty($exception)) {
                $response = ['error' => __('Response Execute Error')];
                if (config('app.debug')) {
                    $response['exception'] = get_class($exception); // Reflection might be better here
                    $response['message'] = __($exception->getMessage());
                    $response['file'] = $exception->getFile();
                    $response['line'] = $exception->getLine();
                    $response['trace'] = $exception->getTrace();
                }
                $status = Response::HTTP_BAD_REQUEST;
                if ($exception instanceof ValidationException) {
                    return parent::render($request, $exception);
                } else if ($exception instanceof AuthenticationException) {
                    $status = Response::HTTP_UNAUTHORIZED;
                    $response['error'] = __($exception->getMessage());
                } else if ($exception instanceof \PDOException) {
                    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
                    $response['error'] = __('Query Syntax Error');
                } else if ($exception and $this->isHttpException($exception)) {
                    $status = $exception->getStatusCode();
                    $response['error'] = __('Response Error');
                } else {
                    $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : Response::HTTP_BAD_REQUEST;
                }
                $message = __($response['message'] ?? $response['error'] ?? Response::$statusTexts[$status]);

                return app_response($response, $message, $status);
            }
        }
        return parent::render($request, $exception);
    }
}
