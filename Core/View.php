<?php

namespace PhpMvcFramework\Core;

class View
{
    /**
     * @param string $viewName
     * @param array $data
     */
    public static function show(string $viewName, array $data = [])
    {
        extract($data);
        $viewName = str_replace('.', '/', $viewName);
        ob_start();
        require dirname(__DIR__) . '/resources/views/' . $viewName . '.php';
        return ob_get_clean();
    }
}