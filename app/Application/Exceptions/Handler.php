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
use Illuminate\Http\Response;
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
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception|Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof ClientException) {
            abort(400);
        }

        if ($e instanceof HttpException) {
            return response([
                'message' => trans('exceptions.not_found_r'),
            ], Response::HTTP_NOT_FOUND);
        }

        if (
            $e instanceof DomainException ||
            $e instanceof SignatureInvalidException ||
            $e instanceof RouteNotFoundException ||
            $e instanceof ExpiredException
        ) {
            return response([
                'message' => trans('exceptions.not_auth'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof UrlGenerationException) {
            return response([
                'message' => trans('exceptions.invalid_request'),
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($e instanceof InvalidArgumentException) {
            return response([
                'message' => trans('exceptions.invalid_request'),
            ], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof ValidationException) {
            $errors = [];

            foreach ($e->validator->getMessageBag()->getMessages() as $name => $error) {
                $errors = array_merge($errors, [
                    $name => $error[0]
                ]);
            }

            return response([
                'message' => trans('exceptions.invalid_data'),
                'inputs' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof ThrottleRequestsException) {
            return response([
                'message' => trans('exceptions.too_many_request'),
            ], Response::HTTP_TOO_MANY_REQUESTS)->withHeaders($e->getHeaders());
        }

        if ($e instanceof ModelNotFoundException) {

            return response([
                'message' => trans('exceptions.model_not_found', [
                    'model' => trans('models.' . $e->getModel()),
                ]),
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {

            return response([
                'message' => trans('exceptions.not_found'),
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof UnauthorizedException) {
            return response([
                'error_code' => 1002,
                'message' => trans('exceptions.not_access'),
            ], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof AuthorizationException) {
            return response([
                'message' => trans('exceptions.not_access'),
            ], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof AuthenticationException) {
            return response([
                'error_code' => 1001,
                'message' => trans('exceptions.not_auth'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof AccessDeniedHttpException) {
            return response([
                'message' => trans('exceptions.access_deny'),
            ], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response([
                'message' => trans('exceptions.method_not_allow'),
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return parent::render($request, $e);
    }
}
