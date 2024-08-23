<?php

namespace App\Controllers;

use App\Classes\DB;

class LoginController
{
    public function login()
    {
        return include_once(base() . '/View/login.php');
    }
}