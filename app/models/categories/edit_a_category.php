<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/CategoryController.php';



if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $flag = 0;
  $errorEditCategory = '';

$database = new DB(SERVER, DATABASE, USERNAME, PASS);

$reName = '/^[A-z]{2,}(\s([A-z]{2,}))*$/';


$category_name = $_POST['_category_name'];
$cat_id = $_POST['_category_id'];

if(!preg_match($reName, $category_name))

{
  $flag++;
  $errorEditCategory .= 'Inccorect name!';
}


if($flag > 0)
{
  echo json_encode(['error' => $errorEditCategory]);exit;
}

else {

  try {

    $categoryController = new CategoryController();
    $categoryController -> updateCategoryName($category_name, $cat_id);
    http_response_code(204);


  }

  catch(PDOException $e)
  {
    require_once(__DIR__."/../../config/functions.php");
    catchErrors($e -> getMessage());
    http_response_code(500);
  }
}

}

else {
  http_response_code(400);
}
