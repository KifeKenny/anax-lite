<?php

$url_check_registration = $app->url->create("check");
$url_logout = $app->url->create("logout");

if ($app->session->get('name') == "admin") {
    echo "";
} elseif ($app->session->has("name")) {
    echo "<p>You are already logged in as " . $app->session->get('name') . "</p>";
    echo "<p>You can't register while loged in</p>";
    echo "<p><a href=$url_logout>Logout</a></p>";
    $user_loggedin = "disabled";
    return;
}
?>
<h1>Register</h1>
<hr>

<form action=<?=$url_check_registration?> method="POST">
    <table class="login">
        <legend><h3>Register form</h3></legend>
        <tr>
            <td>Enter name:</td><td><input type="text" name="new_name"></td>
        </tr>
        <tr>
            <td>Enter pass:</td><td><input type="password" name="new_pass"></td>
        </tr>
        <tr>
            <td>Re pass:</td><td><input type="password" name="new_pass_check"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submitForm" value="register"></td>
        </tr>
    </table>
</form>
<?php
$url = $app->url->create("login");

echo "<a href=$url>Login</a>";
?>

</main>
    </body>
