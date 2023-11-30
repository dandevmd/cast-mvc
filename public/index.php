<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// phpinfo();



const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'vendor/autoload.php';

use Core\Sessions;
use Core\ValidationException;

require BASE_PATH . 'Core/functions.php';


$router = new Core\Router();
$routes = require base_path('routes.php');
require base_path('bootstrap.php');

//start session
session_start();


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    // POST (if log in fails), REQUEST (Do not stay on /session, request the new /login form), GET (Get the new form with old errors which have an expiration date).
    //create the session key and then unset() it after html was screened (this is made in index.php after the routing)
    //do the same for the old data that user entered
    Sessions::flash('errors', $exception->errors);
    Sessions::flash('old', $exception->old);

    redirect($router->previousUrl());

}

Sessions::unflash();
