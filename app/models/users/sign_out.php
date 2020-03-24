<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once '../../controllers/LoginController.php';



if(isset($_SESSION['user']))
{
  $database = new DB(SERVER, DATABASE, USERNAME, PASS);
  $current_user_ID = $_SESSION['user_ID'];

  $loginController = new LoginController();
  $loginController -> displayOfflineActiveStatus($current_user_ID);

  unset($_SESSION['user']);
  session_destroy();

  echo json_encode(['logout' => true]);exit; // P R O V E R I T I


}
