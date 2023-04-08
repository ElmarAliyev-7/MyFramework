<?php

/**
 * @param string $name
 *@param array $params
 * @return string
 */
function route(string $name, array $params = []): string
{
    return \PhpMvcFramework\Core\Route::url($name, $params);
}