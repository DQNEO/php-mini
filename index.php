<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Application.php';
use Symfony\Component\HttpFoundation\Response;

$app = new WAF;

$app->get('/', function () {
    return new Response('hell world');
});

$app->run();

/*
echo "hello world\n";

echo "<pre>\n";
print_r($_SERVER);
*/

