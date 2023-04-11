<?php

namespace PhpMvcFramework\app\Http\Controllers\Front;

use PhpMvcFramework\Core\View;

class Home
{
    public function index()
    {
        return View::show('front.index');
    }
}