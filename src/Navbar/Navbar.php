<?php

namespace watel\Navbar;

/**
 * Navbar to generate HTML för a navbar from a configuration array.
 */
class Navbar implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function setApp($app)
    {
         $this->app = $app;
         return $this;
    }

    public function getHTMLStart()
    {
        $send = '<div class=' . $this->config["config"]["navbar-class"] . '>';
        $send .= '<navbar>';
        return $send;
    }

    public function getHTMLEnd()
    {
        $send = "</navbar>";
        $send .= "</div>";
        $send .= "<main>";
        return $send;
    }

    public function setCurrentRoute($route)
    {
        return $route;
    }

    public function setUrlCreator($create, $route)
    {
        $send = "";
        $send .= $this->getHTMLStart();
        foreach ($this->config["items"] as $key => $value) {
            //remove key validation
            if ($key == "somthing") {
                echo "somthing";
            }
            //check active route
            $active = $value["aclass"];
            if ($route == $value["route"]) {
                $active = "active";
            }
            //create routes and echo out a element whit values
            $url = $create[0]->$create[1]($value["route"]);
            $send .= '<a class=' . $active . ' href=' . $url . '>' . $value["text"] . "</a>";
        }
        $send .= $this->getHTMLEnd();
        return $send;
    }
}
