<?php

namespace PhpMvcFramework\Core;

class Route
{
    public static array $routes = [];
    public static bool $hasRoute = false;

    public static array $patterns = [
        ':id[0-9]?' => '([0-9]+)',
        ':url[0-9]?' => '([0-9a-zA-Z-_]+)'
    ];

    /**
     * @param string $path
     * @param $callback
     */
    public static function get(string $path, $callback): Route
    {
        self::$routes['get'][$path] = [
            'callback' => $callback
        ];
        return new self();
    }

    /**
     * @param string $path
     * @param $callback
     */
    public static function post(string $path, $callback): void
    {
        self::$routes['post'][$path] = [
            'callback' => $callback
        ];
    }

    public static function dispatch()
    {
        $url = self::getUrl();
        $method = self::getMethod();
        foreach (self::$routes[$method] as $path => $props) {
            $callback = $props['callback'];
            foreach (self::$patterns as $key => $pattern) {
                $path = preg_replace('#' . $key . '#', $pattern, $path);
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

    public function name(string $name): void
    {
        $key = array_key_last(self::$routes['get']);
        self::$routes['get'][$key]['name'] = $name;
     }

     public static function url(string $name, array $params = [])
     {
        $route = array_key_first(array_filter(self::$routes['get'], function() use ($name) {
            return $route['name'] = $name;
        }));
        echo $route;
     }
}