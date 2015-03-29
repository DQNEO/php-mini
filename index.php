<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Application.php';
use Symfony\Component\HttpFoundation\Response;

$app = new Application;

$app->get('/', function () {
    return new Response('hell world');
});

$app->get('/monsters/{id}', function ($id) {
    return new Response("the $id th monster");
});

$app->get('/hello/{name}', function ($name) {
    return new Response("hello " . $name);
});

$app->run();
