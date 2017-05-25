<?php

$app->router->add("blogg", function () use ($app) {
    $route = getGet("page", "");
    $id = getGet("id", null);

    $title = "blogg";
    $page = "blogg";

    switch ($route) {
        case "":
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
            $resultset = $app->server->executeFetchAll($sql, ["post"]);
            break;
        default:
            $title = "Blogg Post";
            $page = "showBloggPost";

            $sql2 = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
type = ?
AND slug = ?
AND (deleted IS NULL OR deleted > NOW())
AND published < NOW()
ORDER BY published DESC
;
EOD;
            $slug = $route;
            $resultset = $app->server->executeFetchAll($sql2, ["post", $slug]);
            if (!$resultset) {
                $title = "404";
                $page = "error";
            }
            break;
    }

    $app->renderPage($title, $page, "kmom04", $resultset);
});
