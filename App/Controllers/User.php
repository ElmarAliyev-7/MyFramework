<?php

namespace PhpMvcFramework\App\Controllers;

class User
{
    public function show($id, $id2)
    {
        return 'user id = ' . $id . $id2;
    }
}