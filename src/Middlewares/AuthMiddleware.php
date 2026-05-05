<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ResponseInterface as Response;

class AuthMiddleware
{
    public function __invoke(Request $request, Handler $handler): Response
    {
        // Before logic
        $response = $handler->handle($request);
        // After logic
        return $slimResponse = $response;
    }
}
