<?php

namespace App\Middleware;

class Auth
{
  public function checkToken()
  {
    if (!isset($_SESSION["_accessToken"])){
      if (!(new User())->find($_SESSION["_accessToken"], 'token')){
        header('Location: /login');
        exit;
      }

      header('Location: /login');
      exit;
    }
  }
}