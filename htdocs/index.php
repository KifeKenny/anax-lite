<?php
/**
 * Bootstrap the framework.
 */
// Where are all the files? Booth are needed by Anax.
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

//include session file
// require ANAX_INSTALL_PATH . "/src/Session/Session.php";

// Add all resources to $app
$app = new \watel\App\App();
$app->request = new \Anax\Request\Request();
$app->url     = new \Anax\Url\Url();
$app->router  = new \Anax\Route\RouterInjectable();
$app->request  = new \Anax\Request\Request();
$app->response = new \Anax\Response\Response();
$app->router   = new \Anax\Route\RouterInjectable();
$app->view     = new \Anax\View\ViewContainer();
$app->session     = new \watel\Session\Session();
$app->calandar     = new \watel\Calandar\Calandar();
$app->cookie = new \watel\Session\Cookie();
$app->filter = new \watel\Filter\Filter();

$app->navbar = new \watel\Navbar\Navbar();
$app->navbar->configure("navbar.php");

$app->db = new \watel\Database\DatabaseConfigure();
$app->db->configure("database.php");
$app->db->setDefaultsFromConfiguration();

$app->db->connect();


$app->server = new \watel\DatabaseUpdated\DatabaseConfigure();
$app->server->configure("database.php");
$app->server->setDefaultsFromConfiguration();

$app->server->connect();


$app->navbar->setApp($app);


//start Session
$app->session->start();

// if value is not in session asign key value with the value 0
if (!$app->session->has("value")) {
    $app->session->set("value", 0);
}


// Inject $app into the view container for use in view files.
$app->view->setApp($app);


// Update view configuration with values from config file.
$app->view->configure("view.php");

// Init the object of the request class.
$app->request->init();

// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());


// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute());

// $app = new \watel\App\App();
