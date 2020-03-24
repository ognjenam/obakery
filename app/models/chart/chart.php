<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';


if(isset($_POST['_product_id']))
{
  $product_id = $_POST['_product_id'];



try {

  $database = new DB(SERVER, DATABASE, USERNAME, PASS);
  $productController = new ProductController();

  $product = $productController -> displayProductById($product_id);
  $user = $_SESSION['user'] -> user_ID;
  $date = date("Y-m-d H:i:s");

  $inserted = $productController -> displayToChart($product_id, $user, $date);

}

catch(PDOException $e)
{
  http_response_code(500);
}



  echo json_encode(true);exit;
}

else {
  http_response_code(400);
}
