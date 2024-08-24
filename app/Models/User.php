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

  public function store(
    string $firstName,
    string $lastName,
    string $email,
    string $password
  ){
    $sql = 'INSERT INTO ' . static::$tableName;
    $sql .= ' (first_name, last_name, email, password)';
    $sql .= ' VALUES (:first_name, :last_name, :email, :password)';

    try {
      $this->query->beginTransaction();

      $query = $this->query->prepare($sql);

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $query->bindParam('first_name', $firstName);
      $query->bindParam('last_name', $lastName);
      $query->bindParam('email', $email);
      $query->bindParam('password', $hashedPassword);

      $success = $query->execute();

      $hazardID = $this->query->lastInsertId();

      $this->query->commit();

      return [
        $success,
        $hazardID,
        'User created successfully'
      ];

    } catch (Exception $e) {
      return [
        'false',
        0,
        $e->getMessage()
      ];
    }
  }
}