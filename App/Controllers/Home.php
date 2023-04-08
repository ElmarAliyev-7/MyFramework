<?php

namespace PhpMvcFramework\App\Controllers;

use PhpMvcFramework\Core\View;

class Home
{
    public function index()
    {
        return View::show('index');
    }
}