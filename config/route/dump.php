<?php

$app->router->add("session/dump", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["dump", "../style/style.css"]]);
    $app->view->add("SessionViews/dump");
    $app->view->add("SessionViews/main");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
