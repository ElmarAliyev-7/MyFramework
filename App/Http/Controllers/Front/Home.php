<?php

namespace PhpMvcFramework\App\Http\Controllers\Front;

use PhpMvcFramework\Core\View;

class Home
{
    public function index()
    {
        return View::show('front.index');
    }
}