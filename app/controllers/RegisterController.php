<?php
require_once 'app/models/Register.php';

use app\models\Register;



class RegisterController
{
  public function displayUserByUsername($username) {
    global $database;
    $registerModel = new Register($database);
    $userExists = $registerModel -> getUserByUsername($username);

    return $userExists;
  }

  public function displayUserByEmail($email)
  {
    global $database;
    $registerModel = new Register($database);
    $emailExists = $registerModel -> getUserByEmail($email);
    return $emailExists;
  }


  public function insertUser($email, $pass, $username, $register_date, $last_visit, $active)
  {
    global $database;
    $registerModel = new Register($database);
    $registerModel -> insertUserModel($email, $pass, $username, $register_date, $last_visit, $active);

  }
}
