<?php

$app->router->add("about", function () use ($app) {
    $app->view->add("take1/header", ["title" => "About"]);
    $app->view->add("navbar1/navbar");
    $app->view->add("take1/about");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
