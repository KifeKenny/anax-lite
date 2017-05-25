<?php

$app->router->add("overview", function () use ($app) {
    $route = getGet("route", "");
    $id = getGet("id", null);

    $base_url = $app->url->create("base");

    if ($app->session->get("name") != "admin") {
         header("Location: " . $base_url);
    }



    $overview_url = $app->url->create("overview");
    $blogg_url = $app->url->create("blogg");

    $title = "Overview";
    $page = "overview";
    switch ($route) {
        case "":
            $title = "Overview";
            $resultset = $app->server->executeFetchAll("SELECT * FROM content;");
            break;

        case 'edit':
            $title = "Edit";
            $page = "edit";
            $resultset = $app->server->executeFetchAll("SELECT * FROM content WHERE id='$id';");
            // echo $resultset[0]->slug;
            if (!is_numeric($id)) {
                $title = "Error";
                $page = "error";
                break;
                // die("Not valid for content id.");
            }
            if (hasKeyPost("doDelete")) {
                header("Location: $overview_url?route=delete&id=$id");
                exit;
            }

            if (hasKeyPost("doSave")) {
                $params = getPost([
                    "contentTitle",
                    "contentPath",
                    "contentSlug",
                    "contentData",
                    "contentType",
                    "contentFilter",
                    "contentPublish"
                ]);


                if (!$params["contentSlug"]) {
                    $params["contentSlug"] = slugify($params["contentTitle"]);
                }

                $currentSlug = $params["contentSlug"];

                $sqlSlug = "SELECT slug FROM content WHERE slug='$currentSlug';";
                $curSlug = $app->server->executeFetchAll($sqlSlug);

                if ($curSlug) {
                    if ($resultset[0]->slug != $currentSlug) {
                        $title = "Error";
                        $page = "error";
                        break;
                    }
                }

                if (!$params["contentPublish"]) {
                    $params["contentPublish"] = date('Y-m-d H:i:s');
                }

                if (!$params["contentPath"]) {
                    $params["contentPath"] = null;
                }


                $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = $id;";
                $newSql = sqlParamMerge($sql, array_values($params));
                $app->server->executeFetchAll($newSql);

                $sqlUpdate = "UPDATE content SET updated=NOW() WHERE id='$id';";
                $app->server->executeFetchAll($sqlUpdate);
            }
            $resultset = $app->server->executeFetchAll("SELECT * FROM content WHERE id='$id';");
            break;
        case "create":
            $title = "Create";
            $page = "create";
            if (hasKeyPost("doCreate")) {
                $contentTitle = getPost("newContentTitle");

                $sql = "INSERT into content (title) VALUES ('$contentTitle');";
                $app->server->executeFetchAll($sql);

                $newId = $app->server->executeFetchAll("SELECT id FROM content WHERE title='$contentTitle';");
                $newId = $newId[0]->id;
                header("Location: $overview_url?route=edit&id=$newId");
                exit;
            }
            break;


        case "delete":
            $title = "Delete content";
            $page = "delete";
            if (!is_numeric($id)) {
                die("Not valid for content id.");
            }

            if (hasKeyPost("doDelete")) {
                $sql = "UPDATE content SET deleted=NOW() WHERE id=$id;";
                $app->server->execute($sql);
                header("Location: $overview_url");
                exit;
            }

            if (hasKeyPost("doRealDelete")) {
                $sql = "DELETE FROM content WHERE id='$id';";
                $app->server->execute($sql);
                header("Location: $overview_url");
                exit;
            }
            $sql = "SELECT id, title FROM content WHERE id='$id';";
            $resultset = $app->server->executeFetchAll($sql);
            break;


        case "blogg":
            header("Location: $blogg_url");
            exit;
            break;
    }
    $app->renderPage($title, $page, "kmom04", $resultset);
});
