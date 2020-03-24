<?php

namespace app\models;


class Register {


  private $db;

  public function __construct($database)
  {
    $this -> db = $database;
  }


  public function getUserByUsername($username)
  {
    $query = $this -> db -> getMyDB() -> prepare("SELECT * FROM user WHERE username = ?");
    $query -> execute([$username]);
    return $query -> fetch();
  }

  public function getUserByEmail($email)
  {
    $query = $this -> db -> getMyDB() -> prepare("SELECT * FROM user WHERE e_mail = ?");
    $query -> execute([$email]);
    return $query -> fetch();
  }

  public function insertUserModel($email, $pass, $username, $register_date, $last_visit, $active)
  {

    $query = $this -> db -> getMyDB() -> prepare("INSERT INTO user VALUES(NULL, 2, ?, ?, ?, ?, 0, 0)");
    $query -> execute([$email, $pass, $username, $register_date]);

  }


}
