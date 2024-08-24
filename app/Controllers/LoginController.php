<?php

namespace App\Controllers;

use App\Classes\DB;

class LoginController
{
    public function login()
    {
        return include_once(base() . '/View/Auth/login.php');
    }

    public function register()
    {
        return include_once(base() . '/View/Auth/register.php');
    }
}