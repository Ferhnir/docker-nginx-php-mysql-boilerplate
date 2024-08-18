<?php

echo (new LoginController())->login();


class LoginController
{
  public function login()
  {
    return require_once(__DIR__ . '/../View/login.php');
  }
}
