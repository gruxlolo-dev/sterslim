<?php

namespace App\Controllers;

use App\Attributes\Route;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    #[Route(path: "/auth", method: "GET")]
    public function index(Request $request, Response $response): Response
    {
        $response->getBody()->write("Auth Controller");
        return $response;
    }
}
