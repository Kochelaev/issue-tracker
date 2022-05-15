<?php

namespace App;

class Route
{
    public static function findActionForURI(string $defController, string $defAction): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, '?'))
            $uri = substr($uri, 0, strrpos($uri, '?'));
        $action = substr(strrchr($uri, '.'), 1) ?: $defAction;
        $uri = substr($uri, 0, strrpos($uri, '.'));
        $uriParts = explode('/', $uri);
        array_walk($uriParts, function (&$value) {
            $value = ucfirst($value);
        });
        $controller = array_pop($uriParts) ?: $defController;
        $namespace = implode('\\', ($uriParts));

        $controller = 'Controllers' . $namespace . '\\' . $controller . 'Controller';
        if (!class_exists($controller)) {
            throw new \ErrorException("Controller $controller does not exist");
        }

        $objController = new $controller;
        if (!method_exists($objController, $action)) {
            throw new \ErrorException("Method $action of $controller does not exist");
        }

        $objController->$action();
    }

    //maybei redirtct to controller\action?
    public static function redirect(string $uri = null): void
    {
        $adress = 'http://' . $_SERVER['HTTP_HOST'] . "/$uri";
        header("Location: $adress");
    }

    public static function redirectBack(): void
    {
        $adress = $_SERVER['HTTP_REFERER'];
        header("Location: $adress");
    }
}
