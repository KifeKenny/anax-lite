<?php

$app->router->add("edit", function () use ($app) {
    $edit_name = isset($_POST["edit_name"]) ? htmlentities($_POST["edit_name"]) : null;
    $changed_pass = isset($_POST["edit_pass"]) ? htmlentities($_POST["edit_pass"]) : null;
    $re_changed_pass = isset($_POST["edit_pass_re"]) ? htmlentities($_POST["edit_pass_re"]) : null;

    $login_url = $app->url->create("login");
    $admin_url = $app->url->create("admin");

     // Make sure no one is logged in
    if ($app->session->get("name") != "admin") {
         header("Location: " . $login_url);
    }

    if ($edit_name != null && $changed_pass != null && $re_changed_pass != null) {
        if ($changed_pass == $re_changed_pass) {
            $crypt_pass = password_hash($changed_pass, PASSWORD_DEFAULT);
            $app->db->changePassword($edit_name, $crypt_pass);
            $message = "Password changed";
            header("Location: " . "$admin_url?show=edit+done");
        } else {
            echo "passwords do not match";
        }
    } else {
        echo "please fill in all the fieldes";
    }

});
