<?php

$app->router->add("about", function () use ($app) {
    $app->view->add("take1/header", ["title" => "About"]);
    $app->view->add("take1/navbar");
    $app->view->add("take1/about");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
