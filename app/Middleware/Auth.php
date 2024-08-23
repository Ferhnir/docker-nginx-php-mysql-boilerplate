<?php

namespace App\Middleware;

use App\Models\User;

class Auth
{
  public function checkToken()
  {
    if (!isset($_SESSION['_accessToken'])){
      header('Location: /login');
      exit;
    }

    if (!(new User())->find($_SESSION["_accessToken"], 'token')){
      header('Location: /login');
      exit;
    }
  }
}