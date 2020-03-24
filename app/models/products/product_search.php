<?php
header("Content-Type: application/json");
session_start();
require_once __DIR__ . '/../../config/DB.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';


if(isset($_POST['_product_name']))
{


  $product_name= '%' . $_POST['_product_name'] . '%';


  try {
    $database = new DB(SERVER, DATABASE, USERNAME, PASS);

    $productController = new ProductController();
    $product = $productController -> displayProductTroughSearch(strtolower($product_name));

    if($product == true)
    {
      $product_id = $product -> product_ID;
      echo json_encode(['product_ID' => $product_id]);exit;
    }

    else {
      echo json_encode(false);exit;
    }


  }

  catch(PDOException $e)
  {
    http_response_code(500);
  }





}

else {
  http_response_code(400);
}
