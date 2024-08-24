<?php

namespace App\Models;

use App\Classes\DB;

class User extends DB
{

  protected static $tableName = 'users';

  public function __construct()
  {
    parent::__construct(static::$tableName);
  }

  public function findByEmail(string $email)
  {
    $query = $this->query->prepare("SELECT * FROM " . static::$tableName . " WHERE email = :email");
    $query->bindParam('email', $email);
    $query->execute();

    return $query->fetchObject();
  }

  public function auth(string $token)
  {
    $query = $this->query->prepare("SELECT * FROM " . statis::$tableName . " WHERE token = :token");
    $query->bindParam('token', $token);
    $query->execute();

    return $query->fetchObject();
  }
}