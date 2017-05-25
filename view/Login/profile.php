<?php

$user_loggedin = "";

$login_url = $app->url->create("login");
$logout_url = $app->url->create("logout");
$change_pass_url = $app->url->create("change_pass");
$overview_url = $app->url->create("overview");

// Make sure no one is logged in
if (!$app->session->has("name")) {
    header("Location: " . $login_url);
}

$name = $app->session->get("name");

?>

<h1>Welcome <?=$app->session->get('name')?></h1>
<hr>
<div class="profile">

<img src="../htdocs/img/profile.png"/>
<p><?=$name?></p>
<a style="margin-right:11px;" href=<?=$logout_url?>>Logout</a>
<!-- <br> -->
<a href=<?=$change_pass_url?>>Change password</a>


<!-- </div> -->

<?php
if ($name == "admin") {
    $admin_url = $app->url->create("admin");
    echo "<br><br>";
    echo "<a href=$admin_url style=margin-right:50px;> Accounts</a>";
    echo "<a href=$overview_url> Overview</a>";
}
echo "</div>";

echo "<p> Getting the name from my cookie: " . $app->cookie->get("name") . "</p>";
echo '<p> $_COOKIE dumped: </p>';
echo "<div class=dump_cookie>";
echo $app->cookie->dump();
echo "</div>";
