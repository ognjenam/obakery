<?php

namespace app\models;


class User {
  private $db;

  public function __construct($database)
{
  $this -> db = $database;
}

public function getAllUsers()
{
  return $this -> db -> executeQuery('SELECT u.*, r.name as role FROM user u INNER JOIN role r WHERE u.role_ID = r.role_ID');
}


}
