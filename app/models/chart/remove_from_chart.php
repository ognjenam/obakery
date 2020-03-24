<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/ChartController.php';



if(isset($_POST['_product_id']))
{
  $product_id = $_POST['_product_id'];
  $user_id = $_SESSION['user'] -> user_ID;



try {

  $database = new DB(SERVER, DATABASE, USERNAME, PASS);
  $chartController = new ChartController();


  $deleted = $chartController -> deletedFromChart($product_id);

  $new_chart = $chartController -> displayAllOrdersByUserIdAjax($user_id);


  
  echo json_encode(['chart' => $new_chart]);exit;



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
