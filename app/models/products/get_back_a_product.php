<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';


$database = new DB(SERVER, DATABASE, USERNAME, PASS);


if(isset($_POST['_product_id'])){

  $product_id = $_POST['_product_id'];

  $productController = new ProductController();
  $productController -> displayBackProduct($product_id);

  // $products = $productController -> displayAllProducts();
  // echo json_encode($products);exit;
}


else {
  http_response_code(400);
}
