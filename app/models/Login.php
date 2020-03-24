<?php

namespace app\models;


class Login {


  private $db;


  public function __construct($database)
  {
    $this -> db = $database;
  }

  public function getUserByEmail($email)
  {
    $query = $this -> db -> getMyDB() -> prepare("SELECT * FROM user WHERE e_mail = ?");
    $query -> execute([$email]);
    return $query -> fetch();
  }


  public function getUserByEmailAndPassword($email, $pass)
  {
    $query = $this -> db -> getMyDB() -> prepare("SELECT * FROM user WHERE e_mail = ? AND password = ?");
    $query -> execute([$email, $pass]);
    return $query -> fetch();

  }

  public function updateLastVisitByUser($date, $user_ID)
  {
    $query = $this -> db -> getMyDB() -> prepare("UPDATE user SET last_visit = ? WHERE user_ID = ?");
    $query -> execute([$date, $user_ID]);
  }

  public function updateActiveStatusToOnline($user_ID)
  {
    $query = $this -> db -> getMyDB() -> prepare("UPDATE user SET active = 1 WHERE user_ID = ?");
    $query -> execute([$user_ID]);
  }

  public function updateActiveStatusToOffline($user_ID)
  {
    $query = $this -> db -> getMyDB() -> prepare("UPDATE user SET active = 0 WHERE user_ID = ?");
    $query -> execute([$user_ID]);

  }
}
