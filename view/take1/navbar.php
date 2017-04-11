<?php
$urlHome  = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");

?>
<div class="nav">
    <navbar>
        <a class="navtext" href="<?= $urlHome ?>">Home</a> |
        <a class="navtext" href="<?= $urlAbout ?>">About</a> |
        <a class="navtext" href="<?= $urlReport ?>">Report</a>
    </navbar>
</div>
<body>
    <main>
