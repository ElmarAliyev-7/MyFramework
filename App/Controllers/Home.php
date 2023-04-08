<?php

namespace PhpMvcFramework\App\Controllers;

class Home
{
    public function index()
    {
        return \route('user', [':id' => 3 , ':id2' => 4]);
    }
}