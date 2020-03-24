<?php
header("Content-Type: application/json");
session_start();
require_once __DIR__ . '/../../config/DB.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../models/phpmailer/contactMailer.php';



if(isset($_POST['_name']) && isset($_POST['_email']) && isset($_POST['_message']))
{


  $name = $_POST['_name'];
  $email = $_POST['_email'];
  $message = $_POST['_message'];

  $reName = '/^[a-zA-Z]{2,}(\s[a-zA-Z]{2,})*$/';
  $reMessage = '/([a-zA-Z]){5,}(\s)*[0-9]*/';

  $flag = 0;
  $errorName = '';
  $errorMessage = '';
  $errorEmail = '';



  if(!preg_match($reName, $name))
  {
    $flag++;
    $errorName .= 'Incorrect name!';
  }
  if(!preg_match($reMessage, $message))
  {
    $flag++;
    $errorMessage .= 'Incorrect message!';
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    $flag++;
    $errorEmail .= 'Incorrect email!';
  }


  if($flag > 0)
  {
    echo json_encode(['errorName' => $errorName, 'errorEmail' => $errorEmail, 'errorMessage' => $errorMessage]);
  }

  else {
    $result = sendContactMail($email, $message, $name);
    $result ? $response = 'Message has been sent!' : $response = 'Message has not been sent!';
    echo json_encode(['errorName' => $errorName, 'errorEmail' => $errorEmail, 'errorMessage' => $errorMessage, 'mailer' => $response]);exit;
  }
}

else {
  http_response_code(400);
}
