<?php

namespace App\Controllers;

use App\Attributes\Route;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    #[Route(path: "/", method: "GET", name: "home")]
    public function index(Request $request, Response $response): Response
    {
        $response->getBody()->write("<h1>🚀 Sterslim v1.1.0 is running!</h1><p>Attribute-based routing is working.</p>");
        return $response;
    }

    #[Route(path: "/hello/{name}", method: "GET")]
    public function hello(Request $request, Response $response, array $args): Response
    {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name!");
        return $response;
    }
}
