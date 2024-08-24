<?php

namespace App\Classes;

use PDO;

use Symfony\Component\Dotenv\Dotenv;

class DB
{
  protected object $query;

  protected static $host;
  protected static $dbName;
  protected static $user;
  protected static $password;

  public function __construct(string $tableName)
  {
    static::$host = $_ENV['DB_HOST'];
    static::$dbName = $_ENV['DB_NAME'];
    static::$user = $_ENV['DB_USERNAME'];
    static::$password = $_ENV['DB_PASSWORD'];

    $this->query = $this->connect();
  }

  public function update(array $params)
  {
    // $query = $this->connect();
    $sql = "UPDATE " . static::$tableName ." SET ";

    foreach($params as $key => $value){
      if ($key == 'id') continue;
      $sqlColumns[] = "$key=:$key";
    }

    $sql .= implode(', ', $sqlColumns);
    $sql .= " WHERE id=:id";

    $query = $this->query->prepare($sql);

    return $query->execute($params);
  }

  public function connect()
  {
    $host = static::$host;
    $dbName = static::$dbName;

    return new PDO(
      "mysql:host=$host;dbname=$dbName",
      static::$user,
      static::$password
    );
  }

  public static function find(mixed $value, string $column = 'id')
  {
    $host = static::$host;
    $dbName = static::$dbName;

    $pdo = new PDO(
      "mysql:host=$host;dbname=$dbName",
      static::$user,
      static::$password
    );

    $sql = "SELECT * FROM " . static::$tableName . " WHERE " . $column . " = :"  . $column;

    $query = $pdo->prepare($sql);
    $query->bindParam($column, $value);
    $query->execute();

    return $query->fetchObject();
  }

  public static function all(string $orderBy = '')
  {
    $host = static::$host;
    $dbName = static::$dbName;

    $pdo = new PDO(
      "mysql:host=$host;dbname=$dbName",
      static::$user,
      static::$password
    );

    $sql = "SELECT * FROM " . static::$tableName . " " . $orderBy;
    $query = $pdo->prepare($sql);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_CLASS);
  }
}