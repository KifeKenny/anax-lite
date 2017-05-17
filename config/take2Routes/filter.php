<?php

$app->router->add("filter", function () use ($app) {
    $app->renderPage("Filter", "filter", "take1");
});
