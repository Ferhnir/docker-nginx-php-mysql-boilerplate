<?php

require_once __DIR__ . '/router.php';

get('/', function() {
  (new App\Middleware\Auth())->checkToken();

  return include('app/View/index.php');
});

get('/approvals/new', function() {

  return include('app/View/newApproval.php');

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

get('/logout', function(){
  session_destroy();
  header('Location: /');
  // header('Location: /login');
  exit;
});

/*
 * Register
 */
get('/register', '/app/register');