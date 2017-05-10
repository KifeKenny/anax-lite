<?php

$app->router->add("register", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["Register", "style/style.css"]]);
    $app->view->add("Login/register");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
