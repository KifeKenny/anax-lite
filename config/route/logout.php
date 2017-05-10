<?php

// header('Location: ' . $url);
$app->router->add("logout", function () use ($app) {
     $login_url = $app->url->create("login");
    if (!$app->session->has("name")) {
         header('Location: '  . $login_url);
    } else {
         $app->session->destroy();
         $has_session = session_status() == PHP_SESSION_ACTIVE;

        if (!$has_session) {
             header("Location: " . $login_url);
        } else {
             echo "somthing went wrong unsuccsessfull logout";
        }
    }
});
