<?php

namespace PhpMvcFramework\Core;

class Route
{
    public static array $routes = [];
    public static bool $hasRoute = false;

    public static array $patterns = [
        ':id' => '([0-9]+)',
        ':url' => '([0-9a-zA-Z-_]+)'
    ];

    /**
     * @param $path
     * @param $callback
     */
    public static function get($path, $callback): void
    {
        self::$routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     */
    public static function post($path, $callback): void
    {
        self::$routes['post'][$path] = $callback;
    }

    public static function dispatch()
    {
        $url = self::getUrl();
        $method = self::getMethod();
        foreach (self::$routes[$method] as $path => $callback) {
            foreach (self::$patterns as $key => $pattern) {
                $path = str_replace($key, $pattern, $path);
            }

            $pattern = '#^' . $path . '$#';
            if(preg_match($pattern, $url, $params)){

                array_shift($params);

                self::$hasRoute = true;

                if(is_callable($callback)) {
                    echo call_user_func_array($callback, $params);
                } elseif (is_string($callback)) {

                    [$controllerName, $methodName] = explode('@', $callback);
                    $controllerName = '\PhpMvcFramework\App\Controllers\\'. $controllerName;
                    $controller = new $controllerName();
                    echo call_user_func_array([$controller, $methodName], $params);
                }
            }
        }
        self::hasRoute();
    }

    public static function hasRoute()
    {
        if(self::$hasRoute === false){
            die('404 page');
        }
    }

    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        return str_replace(getenv('BASE_PATH'), null, $_SERVER['REQUEST_URI']);
    }
}