<?php

namespace App\Models;

use App\Classes\DB;

class HazardExposure extends DB
{
  protected static $tableName = 'hazard_exposures';

  public function __construct()
  {
    parent::__construct(static::$tableName);
  }
}