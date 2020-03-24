<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once '../../controllers/RegisterController.php';

$database = new DB(SERVER, DATABASE, USERNAME, PASS);

if(isset($_POST['_username']) && isset($_POST['_email']) && isset($_POST['_pass']))
{

  $username = $_POST['_username'];
  $email = $_POST['_email'];
  $pass = md5($_POST['_pass']);


  $errorUsername = '';
  $errorPassword = '';
  $errorEmail = '';
  $flag = 0;
  $inserted = 0;

  // if he already exists
  $registerController = new RegisterController();

  $userExists = $registerController -> displayUserByUsername($username);
  $emailExists = $registerController -> displayUserByEmail($email);

  if($userExists)
  {
    $errorUsername .= 'Username already exists!';
    $flag++;
  }

  if($emailExists)
  {
    $errorEmail .= 'E-mail already exists!';
    $flag++;
  }

  if($flag > 0)
  {
    echo json_encode(['errorUsername' => $errorUsername, 'errorEmail' => $errorEmail]);exit;
  }

  // if he doesn't exist, he can join in da club :)

  else if($flag == 0) {




    $regUsername = "/^[a-z]{3,8}((\_{0,2})(\d{0,3}))$/";
    $regPassword = "/([\w\W\D\d]){7,}/";
    $regEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})*$/";


    if(!preg_match($regUsername, $username))
    {
      $flag++;
      $errorUsername .= 'Not valid username!';
    }

    if(!preg_match($regPassword, $pass))
    {
      $flag++;
      $errorPassword .= 'At least 7 characters!';
    }

    if(!preg_match($regEmail, $email))
    {
      $flag++;
      $errorEmail .= 'Not valid e-mail!';
    }


    if($flag > 0)
    {
      echo json_encode(['errorUsername' => $errorUsername, 'errorPassword' => $errorPassword, 'errorEmail' => $errorEmail]);exit;
    }

    else if($flag == 0)
    {
      $date = date('Y-m-d H:i:s');
      $last_visit = 0;
      $active = 0;
      $registerController = new RegisterController();
      $registerController -> insertUser($email, $pass, $username, $date, $last_visit, $active);
      $inserted = 1;
      echo json_encode(['registered' => $inserted]);exit;

    }
}

  }

  else {
    http_response_code(400);
  }
