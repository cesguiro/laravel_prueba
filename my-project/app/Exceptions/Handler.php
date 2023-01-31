<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (Throwable $exception) {
            //dd($exception);
            if (request()->is('api*')) {
                //echo \get_class($exception);
                if ($exception instanceof ModelNotFoundException) {
                    //echo "hola";
                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                } 
                else if($exception instanceof NotFoundHttpException) {
                    //var_dump($exception);
                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                }
                else if ($exception instanceof ValidationException)
                    return response()->json(['error' => 'Datos no válidos'], 400);
                else if ($exception instanceof AuthenticationException) {
                    //var_dump($exception);
                    return response()->json(['error' => 'Usuario no autenticado'], 401);
                }
                else if (isset($exception))
                    return response()->json(['error' => 'Error: ' . $exception->getMessage()], 500);
            }
        });
    }
}
