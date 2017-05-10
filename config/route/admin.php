<?php


$app->router->add("admin", function () use ($app) {
     $user_name = $app->session->get("name");
     $profile_url = $app->url->create("profile");

    if ($user_name != "admin") {
        header("Location: " . $profile_url);
    } else {
        $app->view->add("take1/header", ["title" => ["Admin", "style/style.css"]]);
        $app->view->add("Login/admin");
        $app->view->add("take1/footer");

        $app->response->setBody([$app->view, "render"])
                       ->send();
    }
});
