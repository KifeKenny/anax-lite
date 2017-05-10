<?php

$app->router->add("check", function () use ($app) {
     $new_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
     $new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
     $check_pass = isset($_POST["new_pass_check"]) ? htmlentities($_POST["new_pass_check"]) : null;

    if ($new_name != null && $new_pass != null && $check_pass != null) {
        if ($new_pass == $check_pass) {
            if (!$app->db->exists($new_name)) {
                 $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);

                 $app->db->addUser($new_name, $crypt_pass);
                 $message = "User added";
            } else {
                 $message = "Username already exists";
            }
        } else {
             $message = "passwords dont match";
        }
    } else {
         $message = "Please fill in all the fields";
    }

     $app->view->add("take1/header", ["title" => ["check", "style/style.css"]]);
     $app->view->add("Login/check", ["message" => $message]);
     $app->view->add("take1/footer");
     $app->response->setBody([$app->view, "render"])
                   ->send();

});
