<?php
// root file

// public/index.php
use Core\Session;
use Core\ValidationException;

// Start the session
session_start();

// Define the base path
const BASE_PATH = __DIR__.'/../';

// Require the functions
require BASE_PATH.'Core/functions.php';

// Autoload classes
spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

// Require the bootstrap file
require base_path('bootstrap.php');

// Require the routes file
$router = new \Core\Router();
$routes = require base_path('routes.php');

// Load the routes
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    // Store the form data in the session
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    // If the form is invalid, redirect back to the form with the errors
    return redirect($router->previousUrl());
}

Session::unflash();
