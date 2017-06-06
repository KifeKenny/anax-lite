<?php

$app->router->add("shop", function () use ($app) {
    $usefullSql = <<<EOD
SELECT
    P.id,
    P.description,
    P.image,
    P.price,
    GROUP_CONCAT(category) AS category,
    stockStatus(PCI.items) AS inventoryStatus
    -- P.inventoryStatus
FROM Product AS P
    INNER JOIN Prod2Cat AS P2C
        ON P.id = P2C.prod_id
    INNER JOIN ProdCategory AS PC
        ON PC.id = P2C.cat_id
    INNER JOIN Inventory AS PCI
        ON PCI.id = P.id
GROUP BY P.id
ORDER BY P.description
;
EOD;
    $resultset = $app->server->executeFetchAll("$usefullSql");
    $app->renderPage("Shop", "shop", "webbshop", $resultset);
});

$app->router->add("adminShop", function () use ($app) {
    $route = getGet("route", null);
    $id = getGet("id", null);

    $usefullSql = <<<EOD
SELECT
    P.id,
    P.description,
    P.image,
    P.price,
    P.deleted,
    GROUP_CONCAT(category) AS category,
    -- stockStatus(PCI.items) AS inventoryStatus
    P.inventoryStatus
FROM Product AS P
    INNER JOIN Prod2Cat AS P2C
    	ON P.id = P2C.prod_id
    INNER JOIN ProdCategory AS PC
    	ON PC.id = P2C.cat_id
GROUP BY P.id
ORDER BY P.description
;
EOD;
    $base_url = $app->url->create("base");
    if ($app->session->get("name") != "admin") {
         header("Location: " . $base_url);
    }
    $resultset = $app->server->executeFetchAll($usefullSql);

    $shop_url = $app->url->create("adminShop");

    $title = "AdminShop";
    $page = "adminShop";
    $folder = "webbshop";
    $other = null;
    $third = null;

    switch ($route) {
        case 'edit':
            $title = "Shop edit";
            $page = "edit";

            if (!is_numeric($id)) {
                $title = "Error";
                $page = "error";
                break;
                // die("Not valid for content id.");
            }

            if (hasKeyPost("doSave")) {
                $params = getPost([
                    "contetndescription",
                    "contentImage",
                    "contentPrice"
                ]);
                $newCat = getPost("category");
                $newCat = intval($newCat);

                $sql = "UPDATE Product SET description=?, image=?, price=? WHERE id = $id;";
                $app->server->executeFetchAll($sql, array_values($params));
                $app->server->executeFetchAll("UPDATE Prod2Cat SET cat_id=$newCat WHERE prod_id= $id;");
            }

            if (hasKeyPost("doDelete")) {
                $app->server->executeFetchAll("UPDATE Product SET deleted=NOW() WHERE id= $id;");
                header("Location: $shop_url");
                break;
            }

            $resultset = $app->server->executeFetchAll("SELECT * FROM Product WHERE id='$id';");
            $cat_id = $app->server->executeFetchAll("SELECT cat_id FROM Prod2Cat WHERE prod_id=$id;");
            $cat_id = $cat_id[0]->cat_id;
            $other = $app->server->executeFetchAll("SELECT * FROM ProdCategory WHERE id='$cat_id';");
            $third = $app->server->executeFetchAll("SELECT * FROM ProdCategory;");

            break;
        case 'storage':
            $title = "Storage Webbshop";
            $page = "storage";

            if (!is_numeric($id)) {
                $title = "Error";
                $page = "error";
                break;
            }

            if (hasKeyPost("doSave")) {
                $params = getPost([
                    "contentShelf",
                    "contentAmount"
                ]);

                $sql = "UPDATE Inventory SET shelf_id=?, items=? WHERE prod_id = $id;";
                $app->server->executeFetchAll($sql, array_values($params));
            }

            $other = $app->server->executeFetchAll("SELECT description FROM Product WHERE id='$id';");
            $resultset = $app->server->executeFetchAll("SELECT * FROM Inventory WHERE id='$id';");
            break;
        case 'create':
            $title = "Create Product";
            $page = "create";

            if (hasKeyPost("doCreate")) {
                $contentD = getPost("newContentDescription");

                // var_dump($contentD);
                $sql = "INSERT into Product (description) VALUES ('$contentD');";
                $app->server->executeFetchAll($sql);

                $newId = $app->server->executeFetchAll("SELECT id FROM Product WHERE description='$contentD';");
                $newId = $newId[0]->id;
                $app->server->executeFetchAll("INSERT INTO Prod2Cat (prod_id, cat_id) VALUES ($newId, 1);");
                $app->server->executeFetchAll("INSERT INTO Inventory (prod_id) VALUES ($newId);");

                header("Location: $shop_url?route=edit&id=$newId");
                exit;
            }

            break;
        default:
            break;
    }
    $app->renderPageMoreOpptions($title, $page, $folder, [$resultset, $other, $third]);

});
