<?php

namespace App\Models;

use App\Classes\DB;
use Carbon\Carbon;

class HazardDocument extends DB
{

  protected static $tableName = 'hazard_documents';

  public function __construct()
  {
    parent::__construct(static::$tableName);
  }

  public function store(
    string $jobPosition,
    string $place,
    Carbon $date,
    string $jobDescription,
    string $machines = '',
    string $materials = '',
    string $tools = '',
    string $chemicals = ''
  )
  {
    $sql = "INSERT INTO " . static::$tableName;
    $sql .= " (job_position, place, date, job_description, machines, materials, tools, chemicals) ";
    $sql .= "VALUES (:job_position, :place, :date, :job_description, :machines, :materials, :tools, :chemicals)";

    try {
      $this->query->beginTransaction();

      $query = $this->query->prepare($sql);

      $query->bindParam('job_position', $jobPosition);
      $query->bindParam('place', $place);
      $query->bindParam('date', $date);
      $query->bindParam('job_description', $jobDescription);
      $query->bindParam('machines', $machines);
      $query->bindParam('materials', $materials);
      $query->bindParam('tools', $tools);
      $query->bindParam('chemicals', $chemicals);

      $success = $query->execute();

      $documentID = $this->query->lastInsertId();

      $this->query->commit();

      return [
        $success,
        $documentID,
        'Document created successfully'
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