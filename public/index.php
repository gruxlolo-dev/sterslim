<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function ($req, $res) {
    $res->getBody()->write("🚀 Starter Kit Running");
    return $res;
});

$app->run();
