<?php

namespace App\Models;

use App\Classes\DB;

class HazardResault extends DB
{
  protected static $tableName = 'hazard_resaults';

  public function __construct()
  {
    parent::__construct(static::$tableName);
  }
}