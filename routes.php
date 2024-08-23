<?php

require_once __DIR__ . '/router.php';

get('/', function() {
  (new App\Middleware\Auth())->checkToken();

  return include('app/View/index.php');
});

/*
 * Login
 */
get('/login', function(){
  return (new App\Controllers\LoginController())->login();
});

post('/login', function(){
  return (new App\Controllers\AuthController())->login($_POST);
});

/*
 * Register
 */
get('/register', '/app/register');