<?php

$app->router->add("about", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["About", "style/style.css"]]);
    $app->view->add("take1/about");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
