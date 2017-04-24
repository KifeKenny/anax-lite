<?php

$app->router->add("session", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["Session|Main", "style/style.css"]]);
    $app->view->add("SessionViews/main");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
