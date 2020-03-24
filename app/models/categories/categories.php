<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/CategoryController.php';

$database = new DB(SERVER, DATABASE, USERNAME, PASS);

$categoryController = new CategoryController();
$categories = $categoryController -> displayAllCategories();

echo json_encode($categories);exit;
