<?php

namespace PhpMvcFramework\app\Http\Controllers\Front;

class User
{
    public function show($id, $id2)
    {
        return 'user id = ' . $id . $id2;
    }
}