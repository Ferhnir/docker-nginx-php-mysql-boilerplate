<?php

namespace App\Middleware;

use App\Models\User;

class Auth
{
  public function checkToken()
  {
    if (!isset($_SESSION['_accessToken'])){
      return false;
    }

    if (!(new User())->find($_SESSION["_accessToken"], 'token')){
      return false;
    }

    return true;
  }
}