<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once __DIR__.'/../../controllers/ProductController.php';



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $database = new DB(SERVER, DATABASE, USERNAME, PASS);
    $reName = '/^[A-z]{2,}((\s[A-z]{2,}))*$/';
    $reDescr = '/[A-z]{3,}\s*/';
    $rePrice = '/^\d?\d{1}\.\d{2}$/';


    $product_id = $_POST['product_id'];
    $productController = new ProductController();

    $product_details = $productController -> displayProductByIdEdit($product_id);







    global $new_image_updated;
    $product_name = $_POST['product_name'];

    $product_price = $_POST['product_price'];
    $product_descr = $_POST['product_descr'];

    $image_allowed_extensions = ['image/jpg', 'image/png', 'image/jpeg'];
    $flag = 0;
    $errorEditProdName = '';
    $errorEditProdDescr = '';
    $errorEditProdPrice = '';
    $errorEditProdCat = '';
    $errorEditProdImg = '';


    $imageFromDatabase = $product_details -> image;

    $new_image_updated = $imageFromDatabase;


    if(isset($_FILES['image'])) // IMG

    {

      unlink( __DIR__ . '/../../../assets/images/' . $product_details -> image);

      $category_name = $product_details -> categoryName;
      $image_type = $_FILES['image']['type'];


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
      $new_path_image = __DIR__ . '/../../../assets/images/' . $category_name . '/' . $microtime_int . $img_name;


      $new_image_updated_01 = $new_path_image;

      if($image_type == 'image/jpg')
      {
        imagejpeg($new_image, $new_image_updated_01, 100);
      }

      else if($image_type == 'image/png'){
        imagepng($new_image, $new_image_updated_01, 100);
      }

      else if($image_type == 'image/jpeg'){
        imagejpeg($new_image, $new_image_updated_01, 100);
      }

      $new_image_updated = $new_image_updated_01;

      $explode_image = explode('/', $new_path_image);
      $new_image_updated = $explode_image[6] . '/' . $explode_image[7];





    }

    try {


      $productController -> updateProduct($product_name, $product_price, $new_image_updated, $product_descr, $product_id);
      http_response_code(204);

    }

    catch(PDOException $e)
    {
      require_once(__DIR__."/../../config/functions.php");
      catchErrors($e -> getMessage());
      http_response_code(500);
    }






}

else {
  http_response_code(400);
}
