<?php

namespace PhpMvcFramework\app\Http\Controllers\Admin;

use PhpMvcFramework\Core\View;

class Auth
{
    public function login()
    {
        return View::show('admin.auth.login');
    }

    public function loginPost()
    {
        return $_REQUEST;
    }
}