<?php

namespace PhpMvcFramework\Core;

use PhpMvcFramework\App\Http\Helpers\Redirect;

class Route
{
    public static array $routes = [];
    public static bool $hasRoute = false;
    public static string $prefix = '';

    public static array $patterns = [
        ':id[0-9]?' => '([0-9]+)',
        ':url[0-9]?' => '([0-9a-zA-Z-_]+)'
    ];

    /**
     * @param string $path
     * @param $callback
     * @return Route
     */
    public static function get(string $path, $callback): Route
    {
        self::$routes['get'][self::$prefix . $path] = [
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
            foreach (self::$patterns as $key => $pattern) {
                $path = preg_replace('#' . $key . '#', $pattern, $path);
            }
            $pattern = '#^' . $path . '$#';

            if(preg_match($pattern, $url, $params)){
                self::$hasRoute = true;
                array_shift($params);

                if(isset($props['redirect'])){
                    Redirect::to($props['redirect'], $props['status']);
                } else {
                    $callback = $props['callback'];
                    if(is_callable($callback)) {
                        echo call_user_func_array($callback, $params);
                    } elseif (is_string($callback)) {
                        [$controllerName, $methodName] = explode('@', $callback);
                        $controllerName = '\PhpMvcFramework\app\Http\Controllers\\'. $controllerName;
                        $controller = new $controllerName();
                        print_r(call_user_func_array([$controller, $methodName], $params));
                    }
                }
            }
        }
        self::hasRoute();
    }

    public static function hasRoute(): void
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

     public static function url(string $name, array $params = []): string
     {
         $route = array_key_first(array_filter(self::$routes['get'], function ($route) use ($name) {
             return isset($route['name']) && $route['name'] === $name;
         }));
        return getenv('BASE_PATH') . str_replace(array_map(fn($key) => ':' . $key, array_keys($params)), array_values($params), $route);
     }

     public static function prefix($prefix): Route
     {
         self::$prefix = $prefix;
         return new self();
     }

     public static function group(\Closure $closure): void
     {
         $closure();
         self::$prefix = '';
     }

     public function where($key, $pattern): void
     {
        self::$patterns[':' . $key] = '(' . $pattern . ')';
     }

     public static function redirect($from, $to, $status = 301): void
     {
        self::$routes['get'][$from] = [
            'redirect' => $to,
            'status' => $status
        ];
     }
}