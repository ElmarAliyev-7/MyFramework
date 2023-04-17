<?php

use PhpMvcFramework\Core\{Route, View};

/**
 * @param string $name
 *@param array $params
 * @return string
 */
function route(string $name, array $params = []): string
{
    return Route::url($name, $params);
}

/**
 * @param string $name
 * @param array $data
 * @return string
 */
function view(string $name, array $data = []): string
{
    return View::show($name, $data);
}

/**
 * @param string $path
 * @return string
 */
function asset(string $path): string
{
    return getenv('APP_URL') . '/public' . $path;
}