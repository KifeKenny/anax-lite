<?php

$app->router->add("check_change_pass", function () use ($app) {

    $curr_pass = isset($_POST["curr_pass"]) ? htmlentities($_POST["curr_pass"]) : null;
    $changed_pass = isset($_POST["changed_pass"]) ? htmlentities($_POST["changed_pass"]) : null;
    $re_changed_pass = isset($_POST["re_changed_pass"]) ? htmlentities($_POST["re_changed_pass"]) : null;

    $login_url = $app->url->create("login");

     // Make sure no one is logged in
    if (!$app->session->has("name")) {
         header("Location: " . $login_url);
    }

    $user = $app->session->get("name");

    if ($curr_pass != null && $changed_pass != null && $re_changed_pass != null) {
        if ($changed_pass == $re_changed_pass) {
            $the_pass = $app->db->getHash($user);
            if (password_verify($curr_pass, $the_pass)) {
                $crypt_pass = password_hash($changed_pass, PASSWORD_DEFAULT);
                $app->db->changePassword($user, $crypt_pass);
                $message = "Password changed";
            } else {
                $message = "Incorrect password";
            }
        } else {
            $message = "Passwords don't match";
        }
    } else {
        $message = "Please fill in all the fields";
    }


    $app->view->add("take1/header", ["title" => ["Changes Passwors", "style/style.css"]]);
    $app->view->add("Login/check_change_pass", ["message" => $message]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
                   ->send();

});
