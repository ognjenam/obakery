<?php

// require_once '../User.php';

require_once 'app/models/User.php';

use app\models\User;


class UserController {


  public function displayAllUsers()
  {
    global $database;

    $userModel = new User($database);
    $users = $userModel -> getAllUsers();

    includeAdminFiles('/users', ['users' => $users]);
    
  }


}
