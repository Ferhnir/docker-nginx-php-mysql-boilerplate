<?php

require_once __DIR__ . '/router.php';

get('/', function() {
  authenticate();
  return include('app/View/index.php');
});

//HAZARD DOCUMENTS
get('/hazard-documents', function(){
  authenticate();
  return (new App\Controllers\HazardDocumentController())->index();
});

get('/hazard-documents/create', function() {
  authenticate();
  return (new App\Controllers\HazardDocumentController())->create();
});

post('/hazard-documents/create', function() {
  authenticate();
  return (new App\Controllers\HazardDocumentController())->store($_POST);
});

get('/hazard-documents/$doc', 'app/View/HazardDocuments/show.php');

//HAZARDS
get('/hazards/create', 'app/View/Hazards/create.php');

get('/hazards/$hazard', 'app/View/Hazards/show.php');

post('/hazards', function(){
  authenticate();
  return (new App\Controllers\HazardController())->store($_POST);
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
get('/register', function(){
  return (new App\Controllers\LoginController())->register();
});

post('/register', function(){
  return (new App\Controllers\AuthController())->register($_POST);
});

function authenticate()
{
  if (!(new App\Middleware\Auth())->checkToken()){
    header('Location: /login');
    exit;
  }
}