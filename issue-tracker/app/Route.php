<?php

namespace App;

class Route
{
    public static function findActionForURI(string $defController, string $defAction): void
    {
        $uri = urldecode($_SERVER['REQUEST_URI']);
        Validator::correctUriFormat($uri);

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

        self::callAction($namespace, $controller, $action);
    }

    private static function callAction(?string $namespace, string $controller, string $action): void
    {
        $controller = 'Controllers' . $namespace . '\\' . $controller . 'Controller';
        Validator::ControllerExist($controller);
        $objController = new $controller;

        Validator::actionExist($controller, $action);

        $objController->$action();
    }

    public static function redirectBack(): void
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $adress = $_SERVER['HTTP_REFERER'];
            header("Location: $adress");
        } else self::redirect();
    }


    public static function redirect(?string $uri = null): void
    {
        $adress = 'http://' . $_SERVER['HTTP_HOST'] . "/$uri";
        header("Location: $adress");
    }

    public static function modifyActiveUrlQueryParams(array $params): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $parsed = parse_url($url);
        parse_str(@$parsed['query'], $query);
        $query = array_merge($_GET, $params);
        $parsed['query'] = http_build_query($query);
        $newurl = self::buildURL($parsed);
        return $newurl;
    }

    private static function buildURL(array $parsed): ?string
    {
        $url = $_SERVER['HTTP_HOST'];
        if (isset($parsed['path']))     $url .= $parsed['path'];
        if (isset($parsed['query']))    $url .= "?" . $parsed['query'];
        return $url;
    }
}
