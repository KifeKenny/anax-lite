<?php


$app->router->add("back", function () use ($app) {
    $url = $app->url->create("calendar");
    if ($app->session->get("month") == 1) {
        $value = 12;
    } else {
        $value = $app->session->get("month") - 1;
    }
    $app->session->set("month", $value);
    header('Location: ' . $url);
});
