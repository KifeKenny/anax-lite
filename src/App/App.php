<?php

namespace watel\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{
    public function renderPage($title, $page, $folder, $res = null)
    {
        $this->view->add("take1/header", ["title" => ["$title", "style/style.css"]]);
        $this->view->add("$folder/$page", ["resultset" => $res]);
        $this->view->add("take1/footer");

        $this->response->setBody([$this->view, "render"])
                      ->send();
    }
}
