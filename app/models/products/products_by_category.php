<?php
header("Content-Type: application/json");
session_start();
require_once __DIR__ . '/../../config/DB.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';


if(isset($_POST['_category_ID']))
{

  $database = new DB(SERVER, DATABASE, USERNAME, PASS);
  $category = $_POST['_category_ID'];








  $productController = new ProductController();

  if($category == 0)
  {

    $products = $productController -> displayAllProducts();

  }

  else {
    $products = $productController -> displayAllProductsByCategory($category);
  }



  echo json_encode(['products' => $products]);exit;
}
