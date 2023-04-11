<?php

namespace PhpMvcFramework\App\Controllers\Admin;

use PhpMvcFramework\Core\View;

class Auth
{
    public function login()
    {
        return View::show('admin.auth.login');
    }
}