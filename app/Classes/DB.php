<?php

namespace App\Classes;

use PDO;

// use Symfony\Component\Dotenv\Dotenv;

class DB
{
  protected object $query;

  public function __construct(string $tableName)
  {
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
    $host = $_ENV['DB_HOST'];
    $dbName = $_ENV['DB_NAME'];

    return new PDO(
      "mysql:host=$host;dbname=$dbName",
      $_ENV['DB_USERNAME'],
      $_ENV['DB_PASSWORD']
    );
  }

  public function find(mixed $value, string $column = 'id')
  {
    $query = $this->query->prepare("SELECT * FROM " . static::$tableName . " WHERE " . $column . " = :"  . $column);
    $query->bindParam($column, $value);
    $query->execute();

    return $query->fetchObject();
  }
}