<?php

namespace Packages;

use Exception;

/**
 * Class Route
 * @package Packages
 */
class Route
{
    /**
     * Register a new get route.
     *
     * @param $uri
     * @param $class
     * @param $method
     */
    public static function get($uri, $class, $method = null)
    {
        (new self())->register('get', $uri, $class, $method);
    }

    /**
     * Register a route.
     *
     * @param $requestMethod
     * @param $uri
     * @param $class
     * @param $method
     * @throws Exception
     */
    private function register($requestMethod, $uri, $class, $method)
    {
        global $_ROUTES;

        if (!class_exists($class)) {
            $message = "Class {$class} not found. Please, make sure the class exists and is registered in the autoloader";
            throw new Exception($message);
        }

        if (!method_exists($class, $method)) {
            throw new Exception("Method {$method} not found in class {$class}.");
        }

        // $_ROUTES['get']['/login'] = ['class' => 'LoginController', 'method' => 'showForm']
        $uri = trim($uri, '/');
        $_ROUTES[$requestMethod][$uri] = [
            'class' => $class,
            'method' => $method,
        ];

        $_ROUTES['all'][$uri] = true;
    }

    /**
     * Register a new post route.
     *
     * @param $uri
     * @param $class
     * @param $method
     */
    public static function post($uri, $class, $method)
    {
        (new self())->register('post', $uri, $class, $method);
    }
}