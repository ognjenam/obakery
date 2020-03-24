<?php
// require_once 'app/models/Login.php';
require_once 'app/models/Login.php';

use app\models\Login;

class LoginController
{

  public function displayUserByEmail($email)
  {
    global $database;
    $loginModel = new Login($database);
    $emailExists = $loginModel -> getUserByEmail($email);

    return $emailExists;
  }

  public function displayUserByEmailAndPassword($email, $pass)
  {
    global $database;
    $loginModel = new Login($database);
    $user = $loginModel -> getUserByEmailAndPassword($email, $pass);
    return $user;
  }

  public function displayLastVisitByUser($date, $user_ID)
  {
    global $database;
    $loginModel = new Login($database);
    $loginModel -> updateLastVisitByUser($date, $user_ID);
  }

  public function displayOnlineActiveStatus($user_id)
  {
    global $database;
    $loginModel = new Login($database);
    $loginModel -> updateActiveStatusToOnline($user_id);
  }

  public function displayOfflineActiveStatus($user_id)
  {
    global $database;
    $loginModel = new Login($database);
    $loginModel -> updateActiveStatusToOffline($user_id);

    unset($_SESSION['user']);
    session_destroy();
    header('Content-type: application/json');
    echo json_encode(['logout' => true]);exit;



  }





}
