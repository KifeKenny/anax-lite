<?php

$app->router->add("session/status", function () use ($app) {
    $data = [
        "Session name" => session_name(),
        "Session Id" => session_id(),
        "Save path" => session_save_path(),
    ];

    $app->response->sendJson($data);
});
