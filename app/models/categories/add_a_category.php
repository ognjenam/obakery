<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/CategoryController.php';

$database = new DB(SERVER, DATABASE, USERNAME, PASS);

if(isset($_POST['_category_name']))
{
  $category_value = $_POST['_category_name'];

  $flag = 0;
  $errorAddCategory = '';

  $reCategoryName = '/^[A-z]{2,}(\s([A-z]{2,}))*$/';


  if(!preg_match($reCategoryName, $category_value))

  {
    $flag++;
    $errorAddCategory .= 'Incorrect value!';
  }

  if($flag > 0)
  {
    echo json_encode(['errAddCategory' => $errorAddCategory]);exit;
  }

  else {
    $categoryController = new CategoryController();
    $inserted = $categoryController -> newCategory($category_value);

    echo json_encode(['errAddCategory' => $errorAddCategory, 'inserted' => $inserted]);exit;
  }
}
