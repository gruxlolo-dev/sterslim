<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response as SlimResponse;

class TestMiddleware
{
    public function __invoke(Request $request, Handler $handler): Response
    {
        // Example: API Key or Content-Type Check
        if (!$request->hasHeader('Content-Type') && $request->getMethod() === 'POST') {
            $response = new SlimResponse();
            $response->getBody()->write(json_encode(['error' => 'Content-Type header is required']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        return $handler->handle($request);
    }
}
