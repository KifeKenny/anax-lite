<?php


$app->router->add("validate", function () use ($app) {
     $user_name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;
     $password = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;
     $profile_url = $app->url->create("profile");

    if ($user_name != null && $password != null) {
        if ($app->db->exists($user_name)) {
             $the_pass = $app->db->getHash($user_name);
            if (password_verify($password, $the_pass)) {
                 $app->session->set("name", $user_name);
                 $app->cookie->set("name", $user_name);
                 header("Location: " . $profile_url);
            } else {
                 echo "Incorrect password";
            }
        } else {
             echo "Incorrect username";
        }
    } else {
         echo "Password or username not set";
    }
});
