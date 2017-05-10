<?php

$app->router->add("change_pass", function () use ($app) {
     $app->view->add("take1/header", ["title" => ["change pass", "style/style.css"]]);
     $app->view->add("Login/change_pass");
     $app->view->add("take1/footer");
     $app->response->setBody([$app->view, "render"])
                   ->send();

});
