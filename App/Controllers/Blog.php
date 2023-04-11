<?php

namespace PhpMvcFramework\App\Controllers;

use PhpMvcFramework\Core\View;
use PhpMvcFramework\Core\DB;

class Blog
{
    public function index()
    {
        $blogs = DB::table('blogs')->get();
        return View::show('front.blogs.index', ['blogs' => $blogs]);
    }

    public function show($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return View::show('front.blogs.show', ['blog' => $blog]);
    }
}