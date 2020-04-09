<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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
     * @param \Exception|Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \Exception|Throwable $exception
     * @return string
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson() && $exception instanceof ModelNotFoundException) {
            return response([
                'errors' => 'object requested not found'
            ], 404);
        }
        if ($request->wantsJson() && $exception instanceof ValidationException) {
            return response([
                'errors' => $exception->errors()
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
