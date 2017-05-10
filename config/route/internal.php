<?php

$app->router->addInternal("404", function () use ($app) {
    $currentRoute = $app->request->getRoute();
    $routes = "<ul>";
    $showAbleRoutes = [];
    foreach ($app->router->getAll() as $route) {
        array_push($showAbleRoutes, $route->getRule());
        // $routes .= "<li>'" . $route->getRule() . "'</li>";
    }
    // var_dump($showAbleRoutes);
    for ($i=0; $i < count($showAbleRoutes) - 14; $i++) {
        $routes .= "<li>'" . $showAbleRoutes[$i] . "'</li>";
    }
    $routes .= "</ul>";

    $intRoutes = "<ul>";
    foreach ($app->router->getInternal() as $route) {
        $intRoutes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $intRoutes .= "</ul>";

    $body = <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>404</title>
<h1>404 Not Found</h1>
<p>The route '$currentRoute' could not be found!</p>
<h2>Routes loaded</h2>
<p>The following routes are loaded:</p>
$routes
<p>The following internal routes are loaded:</p>
$intRoutes
EOD;

    $app->response->setBody($body)
      ->send(404);
});
