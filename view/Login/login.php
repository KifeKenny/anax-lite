<?php

$user_loggedin = "";
$logout_url = $app->url->create("logout");

// Make sure no one is logged in
if ($app->session->has("name")) {
    echo "<p>You are already logged in as " . $app->session->get('name') . "</p>";
    echo "<p><a href=$logout_url>Logout</a></p>";
    $user_loggedin = "disabled";
    return;
}

$url_validate = $app->url->create("validate");

?>

<h1>Login</h1>
<hr>

<form action=<?=$url_validate?> method="POST">
    <table class="login">
        <legend><h3>Login form</h3></legend>
        <tr>
            <td>Enter name:</td><td><input type="text" name="name" <?=$user_loggedin?>></td>
        </tr>
        <tr>
            <td>Enter pass:</td><td><input type="password" name="pass"<?=$user_loggedin?>></td>
        </tr>
        <tr>
            <td><input type="submit" name="submitForm" value="Login"<?=$user_loggedin?>></td>
        </tr>
    </table>
</form>
<?php
$url = $app->url->create("register");

echo "<a href=$url>Register</a>";
