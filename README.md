# mini - a PHP micro framework

# DESCRIPTION

mini is a PHP micro framework , inspired by Silex and Sinatra

# INSTALLATION

# USAGE

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new \DQNEO\Mini\Application;

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

```

