<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once '../../controllers/LoginController.php';




if(isset($_POST['_email']) && isset($_POST['_pass']))
{
  $database = new DB(SERVER, DATABASE, USERNAME, PASS);
  $email = $_POST['_email'];
  $pass = md5($_POST['_pass']);


  $errorPassword = '';
  $errorEmail = '';
  $flag = 0;



  $regPassword = "/([\w\W\D\d]){7,}/";
  $regEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})*$/";


  if(!preg_match($regEmail, $email))
  {
    $errorEmail .= 'Not valid e-mail!';
    $flag++;
  }

  if(!preg_match($regPassword, $pass))
  {
    $errorPassword .= 'At least 7 characters!';
    $flag++;
  }

  if($flag > 0)
  {
    echo json_encode(['errorPassword' => $errorPassword, 'errorEmail' => $errorEmail]);exit;
  }


  else if($flag == 0)
  {
    $loginController = new LoginController();
    $emailExists = $loginController -> displayUserByEmail($email);

    if(!$emailExists)
    {
      $errorEmail .= 'E-mail doesn\'t exist!';
      echo json_encode(['errorEmail' => $errorEmail]);exit;
    }

    else if($emailExists)
    {
      if($pass != $emailExists -> password)
      {
        $errorPassword .= 'Password doesn\'t match!';
        echo json_encode(['errorPassword' => $errorPassword]);exit;
      }

      else if($pass == $emailExists -> password){

        $loginController = new LoginController();
        $result = $loginController -> displayUserByEmailAndPassword($email, $pass);
        if($result)
        {
          $user = $result;
          $_SESSION['user'] = $user;
          $_SESSION['user_ID'] = $user -> user_ID;
          $_SESSION['username'] = $user -> username;
          $_SESSION['user_role'] = $user -> role_ID;
          


          $last_visit = date("Y-m-d H:i:s");
          $loginController = new LoginController();
          $loginController -> displayLastVisitByUser($last_visit, $_SESSION['user_ID']);
          $loginController -> displayOnlineActiveStatus($_SESSION['user_ID']);



          if($_SESSION['user_role'] == 1)
          {
            echo json_encode(['role' => 1]);exit;
          }
          else if($_SESSION['user_role'] == 2)
          {
            echo json_encode(['role' => 2]);exit;
          }


        }
      }

    }
  }



}
