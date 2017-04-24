<?php

$app->router->add("calendar", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["Home", "style/style.css"]]);
    $app->view->add("take1/calendar");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});
