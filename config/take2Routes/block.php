<?php

$app->router->add("block", function () use ($app) {
    $route = getGet("route", "");
    $title = "Block";
    $page = "block";

    switch ($route) {
        case "":
            $sql = <<<EOD
SELECT
*
FROM content
WHERE type=?
AND path=?
AND (deleted IS NULL OR deleted > NOW())
AND published < NOW()
;
EOD;
            $resultset = $app->server->executeFetchAll($sql, ["block", "Sidebar-right"]);
            break;
        default:
            $resultset = null;
            $title = "404";
            $page = "error";
            if (!$resultset) {
                $title = "404";
                $page = "error";
            }
            break;
    }
    $app->renderPage($title, $page, "kmom04", $resultset);
});
