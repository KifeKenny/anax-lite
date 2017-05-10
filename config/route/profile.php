<?php

$app->router->add("profile", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["Profile", "style/style.css"]]);
    $app->view->add("Login/profile");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
