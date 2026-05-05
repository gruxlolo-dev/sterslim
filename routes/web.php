<?php

use Slim\App;

return function (App $app) {
    $app->get('/hello', function ($req, $res) {
        $res->getBody()->write("Hello World");
        return $res;
    });
};
