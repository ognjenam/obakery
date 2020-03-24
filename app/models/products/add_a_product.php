<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';
require_once __DIR__.'/../../controllers/CategoryController.php';

$database = new DB(SERVER, DATABASE, USERNAME, PASS);


if($_SERVER['REQUEST_METHOD'] === 'POST'){

  $reName = '/^[A-z]{2,}((\s[A-z]{2,}))*$/';
  $reDescr = '/[A-z]{3,}\s*/';
  $rePrice = '/^\d?\d{1}\.\d{2}$/';

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_descr = $_POST['product_descr'];

  $image_allowed_extensions = ['image/jpg', 'image/png', 'image/jpeg'];
  $flag = 0;
  $errorAddProdName = '';
  $errorAddProdDescr = '';
  $errorAddProdPrice = '';
  $errorAddProdCat = '';
  $errorAddProdImg = '';


  if(isset($_POST['product_category']))
  {
    $category = $_POST['product_category']; // CATEGORY

}

      $category_id = $category;
      $categoryController = new CategoryController();
      $category_name = $categoryController -> displayCategoryNameById($category_id);

      $dir_name = __DIR__ . '/../../../assets/images/' . $category_name -> name . '/';

      if(!file_exists($dir_name))
      {
        mkdir($dir_name);
      }




        if(isset($_FILES['image'])) // IMG

        {
          $image_type = $_FILES['image']['type'];

          // resize
          $img_name = $_FILES['image']['name'];

          $img_size = getimagesize($_FILES['image']['tmp_name']); // width, height
          $img_tmp = $_FILES['image']['tmp_name'];

          list($old_w, $old_h) = getimagesize($img_tmp);
          $width = 720;
          $height = 947;

          if($image_type == 'image/jpg')
          {
            $blank = imagecreatefromjpeg($img_tmp);
          }

          else if($image_type == 'image/png'){
            $blank = imagecreatefrompng($img_tmp);
          }

          else if($image_type == 'image/jpeg'){
            $blank = imagecreatefromjpeg($img_tmp);
          }

          $blank_img = imagecreatetruecolor($width, $height);
          imagecopyresampled($blank_img, $blank, 0, 0, 0, 0, $width, $height, $old_w, $old_h);

          $new_image = $blank_img;

          $microtime_int = round(microtime(true) * 1000);
          $new_path_image = $dir_name . $microtime_int . $img_name;


          if($image_type == 'image/jpg')
          {
            imagejpeg($new_image, $new_path_image, 100);
          }

          else if($image_type == 'image/png'){
            imagepng($new_image, $new_path_image, 100);
          }

          else if($image_type == 'image/jpeg'){
            imagejpeg($new_image, $new_path_image, 100);
          }

          $explode_image = explode('/', $new_path_image);
          $db_img_path = $explode_image[6] . '/' . $explode_image[7];


          try {

            $productController = new ProductController();
            $productController -> newProduct($category_id, $product_name, $product_price, $db_img_path, $product_descr, 1);

          }

          catch(PDOException $e)
          {
            require_once(__DIR__."/../../config/functions.php");
            catchErrors($e -> getMessage());
            http_response_code(500);
          }

  }}

  else {
    http_response_code(400);
  }
