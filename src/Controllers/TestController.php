<?php

namespace App\Controllers;

use App\Attributes\Route;
use App\Services\TestService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TestController
{
    private TestService $service;

    public function __construct()
    {
        $this->service = new TestService();
    }

    #[Route(path: "/api/test", method: "GET")]
    public function index(Request $request, Response $response): Response
    {
        $data = $this->service->all();
        
        $response->getBody()->write(json_encode([
            'status' => 'success',
            'message' => 'Test list retrieved',
            'data' => $data
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    #[Route(path: "/api/test", method: "POST")]
    public function store(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $result = $this->service->create($input);

        $response->getBody()->write(json_encode([
            'status' => 'success',
            'message' => 'Test created successfully',
            'data' => $result
        ]));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
