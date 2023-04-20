<?php

namespace PhpMvcFramework\Core;

class Form
{
    public static function request()
    {
        $request = [];
        foreach ($_REQUEST as $key => $value) :
            $request[$key] = trim(htmlspecialchars($value));
        endforeach;
        return $request;
    }
}