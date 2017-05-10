<?php

$login_url = $app->url->create("login");

// Make sure no one is logged in
if (!$app->session->has("name")) {
    header("Location: " . $login_url);
}

$url_validate = $app->url->create("check_change_pass");

?>

<h1>Change password</h1>
<hr>

<form action=<?=$url_validate?> method="POST">
    <table class="login">
        <legend><h3>Change password</h3></legend>
        <tr>
            <td>Password:</td><td><input type="password" name="curr_pass"></td>
        </tr>
        <tr>
            <td>New password:</td><td><input type="password" name="changed_pass"></td>
        </tr>
        <tr>
            <td>Re new password:</td><td><input type="password" name="re_changed_pass"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submitForm" value="Change"></td>
        </tr>
    </table>
</form>
