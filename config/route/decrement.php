<?php


$app->router->add("session/decrement", function () use ($app) {
    $url = $app->url->create("session");
    $value = $app->session->get("value") - 1;
    $app->session->set("value", $value);
    header('Location: ' . $url);
});
