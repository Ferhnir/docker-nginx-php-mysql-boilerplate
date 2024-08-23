<?php
  session_start();

  require_once('./app/Classes/Base.php');

  require_once('./vendor/autoload.php');

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load(__DIR__ . '/.env');

  require_once __DIR__ . '/routes.php';
?>