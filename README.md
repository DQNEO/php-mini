# mini - a PHP micro framework

# DESCRIPTION

mini is a PHP micro framework , inspired by Silex and Sinatra

# INSTALLATION

# USAGE

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new \DQNEO\Mini;

$db = new MyDB();

$app->get('/', function () {
    return new Response('hell world');
});

$app->get('/users/{user_id}', function($user_id) use ($app, $db) {
    if (! is_numeric($user_id)) {
        return new Response('bad argument', 400);
    }

    $items = $db->getUserItems($user_id);
    return new JsonResponse($items);
});

$app->run();

```

