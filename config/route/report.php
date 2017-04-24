<?php

$app->router->add("report", function () use ($app) {
    $app->view->add("take1/header", ["title" => ["Report", "style/style.css"]]);
    $app->view->add("take1/report");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
