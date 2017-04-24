<!doctype html>
<meta charset="utf-8">
<title><?= $title[0] ?></title>
<link rel="stylesheet" href=<?= $title[1] ?>>
<body>
<?php
// $navRoute = $app->navbar->setCurrentRoute($app->request->getRoute());
// echo $app->navbar->create

$navRoute = $app->navbar->setCurrentRoute($app->request->getRoute());
echo $app->navbar->setUrlCreator([$app->url, "create"], $navRoute);
?>
