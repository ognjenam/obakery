<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/CategoryController.php';


$database = new DB(SERVER, DATABASE, USERNAME, PASS);


if(isset($_POST['_category_id'])){

  $category_id = $_POST['_category_id'];

  $categoryController = new CategoryController();
  $categoryController -> displayBackCategory($category_id);

}


else {
  http_response_code(400);
}
