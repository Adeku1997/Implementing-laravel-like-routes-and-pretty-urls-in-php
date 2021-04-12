<?php

$_ROUTES = [
    'get' => [],
    'post' => [],
    'put' => [],
    'patch' => [],
    'delete' => [],
    'all' => [],
];

include "../autoload.php";

/*
|--------------------------------------------------------------
| Interpret the Route
|--------------------------------------------------------------
|
| This is the section that takes care of route interpretation.
| It gets the class and method of the route using the uri.
|
*/

// CLEAN: Get the uri without query parameters.
$uri = explode('?', $_SERVER['REQUEST_URI'])[0];
$uri = trim($uri, '/'); // trim to maintain uniformity and remove unnecessary slash.

$requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
$route = $_ROUTES[$requestMethod][$uri] ?? false; // $_ROUTES['get']['home'] ?? false
$routeExists = $_ROUTES['all'][$uri] ?? false;

// Validate routes.
if (!$routeExists) {
    abort('404');
}

if (!$route) {
    abort('405');
}

// Instantiate the class and execute the method;
$class = $route['class'];
$method = $route['method'];
$parameters = (new \ReflectionMethod($class, $method))->getParameters();

if ($parameters) {
    (new $class)->{$method}($_REQUEST);

    exit();
}

(new $class)->{$method}();