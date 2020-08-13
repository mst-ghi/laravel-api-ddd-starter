<?php

namespace App\Application\Exceptions;

use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;
use DomainException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use GuzzleHttp\Exception\ClientException;
use http\Exception\InvalidArgumentException;
use HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Exceptions\UrlGenerationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if ($exception instanceof ClientException) {
            abort(400);
        }

        if ($exception instanceof HttpException) {
            return response([
                'status_code' => 404,
                'success'     => false,
                'message'     => trans('exceptions.not_found_r'),
            ], 404);
        }

        if (
            $exception instanceof DomainException ||
            $exception instanceof SignatureInvalidException ||
            $exception instanceof RouteNotFoundException ||
            $exception instanceof ExpiredException
        ) {
            return response([
                'status_code' => 401,
                'success'     => false,
                'message'     => trans('exceptions.not_auth'),
            ], 401);
        }

        if ($exception instanceof UrlGenerationException) {
            return response([
                'status_code' => 405,
                'success'     => false,
                'message'     => trans('exceptions.invalid_request'),
            ], 405);
        }

        if ($exception instanceof InvalidArgumentException) {
            return response([
                'status_code' => 403,
                'success'     => false,
                'message'     => trans('exceptions.invalid_request'),
            ], 403);
        }

        if ($exception instanceof ValidationException) {
            $errors = [];

            foreach ($exception->validator->getMessageBag()->getMessages() as $name => $error) {
                $errors = array_merge($errors, [
                    $name => $error[0]
                ]);
            }

            return response([
                'status_code' => 422,
                'success'     => false,
                'message'     => trans('exceptions.invalid_data'),
                'errors'      => $errors,
            ], 422);
        }

        if ($exception instanceof ThrottleRequestsException) {
            return response([
                'status_code' => 429,
                'success'     => false,
                'message'     => trans('exceptions.too_many_request'),
            ], 429)->withHeaders($exception->getHeaders());
        }

        if ($exception instanceof ModelNotFoundException) {

            return response([
                'status_code' => 404,
                'success'     => false,
                'message'     => trans('exceptions.model_not_found', [
                    'model' => trans('models.' . $exception->getModel()),
                ]),
            ], 404);
        }

        if ($exception instanceof NotFoundHttpException) {

            return response([
                'status_code' => 404,
                'success'     => false,
                'message'     => trans('exceptions.not_found'),
            ], 404);
        }

        if ($exception instanceof UnauthorizedException) {
            return response([
                'error_code'  => 1002,
                'status_code' => 403,
                'success'     => false,
                'message'     => trans('exceptions.not_access'),
            ], 403);
        }

        if ($exception instanceof AuthorizationException) {
            return response([
                'status_code' => 403,
                'success'     => false,
                'message'     => trans('exceptions.not_access'),
            ], 403);
        }

        if ($exception instanceof AuthenticationException) {
            return response([
                'error_code'  => 1001,
                'status_code' => 401,
                'success'     => false,
                'message'     => trans('exceptions.not_auth'),
            ], 401);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return response([
                'status_code' => 403,
                'success'     => false,
                'message'     => trans('exceptions.access_deny'),
            ], 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response([
                'status_code' => 405,
                'success'     => false,
                'message'     => trans('exceptions.method_not_allow'),
            ], 405);
        }

        return parent::render($request, $exception);
    }
}
