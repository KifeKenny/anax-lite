<?php

$app->router->add("page", function () use ($app) {
    $route = getGet("route", null);
    $id = getGet("id", null);

    $title = "Pages";
    $page = "page";
    echo $route;
    switch ($route) {
        case "Show-All":
            $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d %H:%i:%s') AS published
FROM content
WHERE type=?
AND (deleted IS NULL OR deleted > NOW())
AND published < NOW()
ORDER BY published DESC
;
EOD;
            $resultset = $app->server->executeFetchAll($sql, ["page"]);
            break;
        default:
            $title = "page";
            $page = "showBloggPost";

            $sql2 = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
type = ?
AND path = ?
AND (deleted IS NULL OR deleted > NOW())
AND published < NOW()
ORDER BY published DESC
;
EOD;
            $path = $route;
            $resultset = $app->server->executeFetchAll($sql2, ["page", $path]);
            if (!$resultset) {
                $title = "404";
                $page = "error";
            }
            break;
    }
    $app->renderPage($title, $page, "kmom04", $resultset);
});
