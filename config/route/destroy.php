<?php


$app->router->add("session/destroy", function () use ($app) {
    $url = $app->url->create("session/dump");
    $app->session->destroy();
    header('Location: ' . $url);
});
