<?php

$app->router->add("login", function () use ($app) {

    // $pass = "test123";
    //
    // // Kryptera lösenordet. PASSWORD_DEFAULT använder den starkaste algoritmen.
    // $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
    //
    // $app->db->addUser("test2", $crypt_pass);
    $app->view->add("take1/header", ["title" => ["Login", "style/style.css"]]);
    $app->view->add("Login/login");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
