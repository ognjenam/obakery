<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/UserController.php';

$database = new DB(SERVER, DATABASE, USERNAME, PASS);

$userController = new UserController();
$users = $userController -> displayAllUsers();

echo json_encode($users);exit;
