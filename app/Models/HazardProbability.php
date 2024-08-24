<?php

namespace App\Models;

use App\Classes\DB;

class HazardProbability extends DB
{
  protected static $tableName = 'hazard_probabilities';

  public function __construct()
  {
    parent::__construct(static::$tableName);
  }
}