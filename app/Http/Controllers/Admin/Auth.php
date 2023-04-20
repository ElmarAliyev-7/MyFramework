<?php

namespace PhpMvcFramework\app\Http\Controllers\Admin;

use PhpMvcFramework\Core\{View, Form, DB};

class Auth
{
    public static array $messages = [];

    public function login()
    {
        return View::show('admin.auth.login');
    }

    public function loginPost()
    {
        $request = Form::request();
        /* Validation */
        if(empty($request['username'])) :
            array_push(self::$messages,'Username filled is required');
        endif;

        if (empty($request['password'])) :
            array_push(self::$messages,'Password filled is required');
        endif;

        if(count(self::$messages) > 0)
            return self::$messages;

        /* Check Credentials */
        $user =  DB::table('users')->where('username', $request['username'])->first();
        if(!$user)
            array_push(self::$messages, 'Credentials doesn\'t match');
            return self::$messages;
        if($user->password == md5($request['password'])) :
            array_push(self::$messages,'Login Successfully');
        else :
            array_push(self::$messages,'Credentials doesn\'t match');
        endif;
        return self::$messages;
    }
}