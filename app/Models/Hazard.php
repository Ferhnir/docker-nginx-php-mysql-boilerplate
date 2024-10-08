<?php

namespace App\Models;

use App\Classes\DB;
use PDO;

class Hazard extends DB
{
  protected static $tableName = 'hazards';

  public function __construct()
  {
    parent::__construct(static::$tableName);
  }

  public static function getByDocument(int $hazardDocumentID)
  {
    $host = static::$host;
    $dbName = static::$dbName;

    $pdo = new PDO(
      "mysql:host=$host;dbname=$dbName",
      static::$user,
      static::$password
    );

    $sql = 'SELECT * FROM ' . static::$tableName;
    $sql .= ' WHERE hazard_document_id = :hazard_document_id';

    $query = $pdo->prepare($sql);

    $query->bindParam('hazard_document_id', $hazardDocumentID);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_CLASS);
  }

  public function store(
    int $hazardDocumentID,
    int $hazardResaultID,
    int $hazardExposureID,
    int $hazardProbabilityID,
    string|null $info = null,
    string|null $source = null,
    string|null $resault = null,
    string|null $methodsAndTools = null
  )
  {
    $sql = 'INSERT INTO ' . static::$tableName;
    $sql .= ' (hazard_document_id, hazard_resault_id, hazard_exposure_id, hazard_probability_id, info, source, resault, methods_and_tools)';
    $sql .= ' VALUES (:hazard_document_id, :hazard_resault_id, :hazard_exposure_id, :hazard_probability_id, :info, :source, :resault, :methods_and_tools)';

    try {
      $this->query->beginTransaction();

      $query = $this->query->prepare($sql);

      $query->bindParam('hazard_document_id', $hazardDocumentID);
      $query->bindParam('hazard_resault_id', $hazardResaultID);
      $query->bindParam('hazard_exposure_id', $hazardExposureID);
      $query->bindParam('hazard_probability_id', $hazardProbabilityID);
      $query->bindParam('info', $info);
      $query->bindParam('source', $source);
      $query->bindParam('resault', $resault);
      $query->bindParam('methods_and_tools', $methodsAndTools);

      $success = $query->execute();

      $hazardID = $this->query->lastInsertId();

      $this->query->commit();

      return [
        $success,
        $hazardID,
        'Hazard created successfully'
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