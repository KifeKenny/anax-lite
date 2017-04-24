<?php


$app->router->add("forward", function () use ($app) {
    $url = $app->url->create("calendar");
    if ($app->session->get("month") > 11) {
        $value = 1;
    } else {
        $value = $app->session->get("month") + 1;
    }
    $app->session->set("month", $value);
    header('Location: ' . $url);
});
