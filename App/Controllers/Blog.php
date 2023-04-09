<?php

namespace PhpMvcFramework\App\Controllers;

use PhpMvcFramework\Core\View;
use PhpMvcFramework\Core\Database;

class Blog
{
    public function index()
    {
        $blogs = Database::table('blogs')->get();
        return View::show('blogs', ['blogs' => $blogs]);
    }

    public function show($id)
    {
        $blog = Database::table('blogs')->where('id', $id)->first();
        return View::show('blog', ['blog' => $blog]);
    }
}