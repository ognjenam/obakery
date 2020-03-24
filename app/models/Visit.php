<?php

namespace app\models;


class Visit {
  private $db;

  public function __construct($database)
{
  $this -> db = $database;
}

public function countAllVisits()
{
  return $this -> db  -> executeOneRow("SELECT number FROM visits");
}

public function restartVisits()
{
  $query = $this -> db -> getMyDb() -> prepare("UPDATE visits SET number = 0");
  $query -> execute();
}
}
