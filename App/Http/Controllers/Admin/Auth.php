<?php

namespace PhpMvcFramework\App\Http\Controllers\Admin;

use PhpMvcFramework\Core\View;

class Auth
{
    public function login()
    {
        return View::show('admin.auth.login');
    }
}