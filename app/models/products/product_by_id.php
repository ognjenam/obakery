<?php
header("Content-Type: application/json");
session_start();
require_once __DIR__ . '/../../config/DB.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';


if(isset($_POST['product_id']))
{


  $product_id = $_POST['product_id'];


  $database = new DB(SERVER, DATABASE, USERNAME, PASS);

  $productController = new ProductController();
  $product = $productController -> displayProductById($product_id);

  echo json_encode($product);exit;
}
