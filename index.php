<?php
ob_start();
session_start();

require_once 'app/config/database.php';
require_once 'app/config/DB.php';
require_once 'app/config/functions.php';
require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/CategoryController.php';
require_once 'app/controllers/ChartController.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/RegisterController.php';
require_once 'app/controllers/LoginController.php';
require_once 'app/controllers/VisitController.php';


// $root = $_SERVER['DOCUMENT_ROOT'];
// echo $root;





$database = new DB(SERVER, DATABASE, USERNAME, PASS);


//

$productController = new ProductController();

$categoryController = new CategoryController();

$chartController = new ChartController();

$userController = new UserController();

$registerController = new RegisterController();

$loginController = new LoginController();

$visitController = new VisitController();






$url = $_SERVER['REQUEST_URI'];
// var_dump($url);
//
$url = str_replace('o_bakery/', '', $url);
//
// echo "</br>";
//



$guest = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
logActivity($guest);




if(isset($_SESSION['user'])){
  if($_SESSION['user_role'] == 1)
  {

    if($url == '/admin')
    {

      $data = @ fopen(__DIR__ . '/app/data/log.txt', 'r');
      if($data)
      {

        $file_data = file (__DIR__ . '/app/data/log.txt');
        fclose($data);


      }
      includeAdminFiles('/home', ['data' => $file_data]);exit;
    }

    else if($url == '/admin/categories')
    {
      $categoryController -> displayAllCategories();

    }


    else if($url == '/admin/products')
    {

      $productController -> allProductsAndCategories();



    }


    else if(isset($_GET['page']))
    {

      global $counter;
      $page = $_GET['page'];

      $limit = ($page - 1) * 5;

      $productController -> displayPagination($limit);


    }
    else if($url == '/admin/users')
    {



        $userController -> displayAllUsers();




    }



    else if($url == '/admin/add/category')
    {
        includeAdminFiles('/add_category');
    }

    else if($url == '/admin/add/product')
    {
        $categoryController -> displayCategoryNamesDropdown();

    }



    else if(isset($_GET['product_id']))
    {

      $prod_id = $_GET['product_id'];
      $productController -> displayProductByIdAdminPanel($prod_id);

    }

    else if(isset($_GET['category_id']))
    {

      $category_id = $_GET['category_id'];
      $categoryController -> displayCategoryById($category_id);

    }


  }
  }





if(isset($_GET['product']))
{
  view('fixed/head');
  view('fixed/header');
  view('fixed/slider');
  $product_id = $_GET['product'];
  $productController -> displayProduct($product_id);
  view('fixed/footer');
}


switch($url) {

  case '':
  case '/index.php':
  case '/home':
  case '/':
  view('fixed/head');
  view('fixed/header');
  view('fixed/slider');
  $database -> visits(); // When goes to website
  $categoryController -> countAllProductsByCategory();

  view('fixed/footer');
  break;

  case '/chart':
  $user = $_SESSION['user'];

  $chart = $chartController -> displayAllOrdersByUserId($_SESSION['user'] -> user_ID);break;




  case '/products':
  view('fixed/head');
  view('fixed/header');
  view('fixed/slider');
  $productController -> displayAllProductsAndAllCategories();

  view('fixed/footer');
  break;

  case '/contact':
  view('fixed/head');
  view('fixed/header');
  view('fixed/slider');
  view('pages/contact');
  view('fixed/footer');
  break;

case '/product_search':

if(isset($_POST['_product_name'])){
try {
  $product_name= '%' . $_POST['_product_name'] . '%';
  $productController -> displayProductTroughSearch(strtolower($product_name));

}

catch(PDOException $e)
{
  http_response_code(500);
}


}
else {
  http_response_code(400);
}
break;

case '/user_chart':
if(isset($_POST['_product_id']))
{

  try {
  $product_id = $_POST['_product_id'];

  $productController -> displayProductById($product_id);
}

catch(PDOException $e)
{
  http_response_code(500);
}
}
else {
  http_response_code(400);
}
break;



case  '/remove_from_chart':
if(isset($_POST['_product_id']))
{

  try {
    $product_id = $_POST['_product_id'];
    $user_id = $_SESSION['user'] -> user_ID;



    $chartController -> deletedFromChart($product_id, $user_id);
  }


  catch(PDOException $e)
  {
    http_response_code(500);
  }
}
else {
  http_response_code(400);
}


break;

case '/contact_form':

  if(isset($_POST['_name']) && isset($_POST['_email']) && isset($_POST['_message']))
  {

    $name = $_POST['_name'];
    $email = $_POST['_email'];
    $message = $_POST['_message'];

    $reName = '/^[a-zA-Z]{2,}(\s[a-zA-Z]{2,})*$/';
    $reMessage = '/([a-zA-Z]){5,}(\s)*[0-9]*/';

    $flag = 0;
    $errorName = '';
    $errorMessage = '';
    $errorEmail = '';

    if(!preg_match($reName, $name))
    {
      $flag++;
      $errorName .= 'Incorrect name!';
    }
    if(!preg_match($reMessage, $message))
    {
      $flag++;
      $errorMessage .= 'Incorrect message!';
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $flag++;
      $errorEmail .= 'Incorrect email!';
    }


    if($flag > 0)
    {
      echo json_encode(['errorName' => $errorName, 'errorEmail' => $errorEmail, 'errorMessage' => $errorMessage]);
    }

    else {

      require_once __DIR__.'/app/models/phpmailer/contactMailer.php';
      $result = sendContactMail($email, $message, $name);

      $result ? $response = 'Message has been sent!' : $response = 'Message has not been sent!';
      header('Content-type: application/json');
      echo json_encode(['errorName' => $errorName, 'errorEmail' => $errorEmail, 'errorMessage' => $errorMessage, 'mailer' => $response]);exit;
    }

  }

  else {
    http_response_code(400);
  }


break;

case '/edit_a_category':

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $flag = 0;
  $errorEditCategory = '';


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
    header('Content-type: application/json');
    echo json_encode(['error' => $errorEditCategory]);exit;
  }

  else {

    try {


      $categoryController -> updateCategoryName($category_name, $cat_id);
      http_response_code(204);


    }

    catch(PDOException $e)
    {

      catchErrors($e -> getMessage());
      http_response_code(500);
    }
  }

}

else {
  http_response_code(400);
}

  break;

  case '/edit_a_product':

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $reName = '/^[A-z]{2,}((\s[A-z]{2,}))*$/';
    $reDescr = '/[A-z]{3,}\s*/';
    $rePrice = '/^\d?\d{1}\.\d{2}$/';

    $product_id = $_POST['product_id'];

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
      unlink( __DIR__ . '/assets/images/' . $product_details -> image);

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
      $new_path_image = __DIR__ . '/assets/images/' . $category_name . '/' . $microtime_int . $img_name;


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
      $new_image_updated = $explode_image[3] . '/' . $explode_image[4];




    }

    try {
      $productController -> updateProduct($product_name, $product_price, $new_image_updated, $product_descr, $product_id);
      http_response_code(204);
    }

    catch(PDOException $e)
    {

      catchErrors($e -> getMessage());
      http_response_code(500);
    }

  }

  else {
    http_response_code(400);
  }

  break;

  case '/get_back_a_product':

  if(isset($_POST['_product_id'])){
    $product_id = $_POST['_product_id'];

    try {
      $productController -> displayBackProduct($product_id);
    }

    catch(PDOException $e)
    {

      catchErrors($e -> getMessage());
      http_response_code(500);
    }
  }

  else {
    http_response_code(400);
  }

  break;

  case '/remove_a_product':

  if(isset($_POST['_product_id'])){
    $product_id = $_POST['_product_id'];

    try {
      $productController -> removeProduct($product_id);
    }

    catch(PDOException $e)
    {

      catchErrors($e -> getMessage());
      http_response_code(500);
    }
  }

  else {
    http_response_code(400);
  }

  break;

  case '/remove_a_category':

  if(isset($_POST['_category_id'])){
    $category_id = $_POST['_category_id'];

    try {
      $categoryController -> removeCategory($category_id);
    }

    catch(PDOException $e)
    {

      catchErrors($e -> getMessage());
      http_response_code(500);
    }
  }

  else {
    http_response_code(400);
  }

  break;

  case '/get_back_a_category':

  if(isset($_POST['_category_id'])){
    $category_id = $_POST['_category_id'];

    try {
      $categoryController -> displayBackCategory($category_id);
    }

    catch(PDOException $e)
    {

      catchErrors($e -> getMessage());
      http_response_code(500);
    }
  }

  else {
    http_response_code(400);
  }

  break;

  case '/register':

  if(isset($_POST['_username']) && isset($_POST['_email']) && isset($_POST['_pass']))
  {

    $username = $_POST['_username'];
    $email = $_POST['_email'];
    $pass = md5($_POST['_pass']);


    $errorUsername = '';
    $errorPassword = '';
    $errorEmail = '';
    $flag = 0;
    $inserted = 0;

    // if he already exists


    $userExists = $registerController -> displayUserByUsername($username);
    $emailExists = $registerController -> displayUserByEmail($email);

    if($userExists)
    {
      $errorUsername .= 'Username already exists!';
      $flag++;
    }

    if($emailExists)
    {
      $errorEmail .= 'E-mail already exists!';
      $flag++;
    }

    if($flag > 0)
    {
      header('Content-type: application/json');
      echo json_encode(['errorUsername' => $errorUsername, 'errorEmail' => $errorEmail]);exit;
    }

      else if($flag == 0) {
        $regUsername = "/^[a-z]{3,8}((\_{0,2})(\d{0,3}))$/";
        $regPassword = "/([\w\W\D\d]){7,}/";
        $regEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})*$/";

        if(!preg_match($regUsername, $username))
        {
          $flag++;
          $errorUsername .= 'Not valid username!';
        }

        if(!preg_match($regPassword, $pass))
        {
          $flag++;
          $errorPassword .= 'At least 7 characters!';
        }

        if(!preg_match($regEmail, $email))
        {
          $flag++;
          $errorEmail .= 'Not valid e-mail!';
        }

        if($flag > 0)
        {
          header('Content-type: application/json');
          echo json_encode(['errorUsername' => $errorUsername, 'errorPassword' => $errorPassword, 'errorEmail' => $errorEmail]);exit;
        }

        else if($flag == 0)
        {
          $date = date('Y-m-d H:i:s');
          $last_visit = 0;
          $active = 0;

          try {
            $registerController -> insertUser($email, $pass, $username, $date, $last_visit, $active);
            $inserted = 1;
            echo json_encode(['registered' => $inserted]);exit;
          }

          catch(PDOException $e)
          {

            catchErrors($e -> getMessage());
            http_response_code(500);
          }


        }

      }


  }


  else {
    http_response_code(400);
  }

  break;

    case '/login':

    if(isset($_POST['_email']) && isset($_POST['_pass']))
    {
      $email = $_POST['_email'];
      $pass = md5($_POST['_pass']);


      $errorPassword = '';
      $errorEmail = '';
      $flag = 0;

      $regPassword = "/([\w\W\D\d]){7,}/";
      $regEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})*$/";

      if(!preg_match($regEmail, $email))
      {
        $errorEmail .= 'Not valid e-mail!';
        $flag++;
      }

      if(!preg_match($regPassword, $pass))
      {
        $errorPassword .= 'At least 7 characters!';
        $flag++;
      }

      if($flag > 0)
      {
        header('Content-type: application/json');
        echo json_encode(['errorPassword' => $errorPassword, 'errorEmail' => $errorEmail]);exit;
      }
      else if($flag == 0)
      {

        $emailExists = $loginController -> displayUserByEmail($email);

        if(!$emailExists)
        {
          $errorEmail .= 'E-mail doesn\'t exist!';
          header('Content-type: application/json');
          echo json_encode(['errorEmail' => $errorEmail]);exit;
        }
        else if($emailExists)
        {
          if($pass != $emailExists -> password)
          {
            $errorPassword .= 'Password doesn\'t match!';
            header('Content-type: application/json');
            echo json_encode(['errorPassword' => $errorPassword]);exit;
          }

          else if($pass == $emailExists -> password){


            $result = $loginController -> displayUserByEmailAndPassword($email, $pass);
            if($result)
            {
              $user = $result;
              $_SESSION['user'] = $user;
              $_SESSION['user_ID'] = $user -> user_ID;
              $_SESSION['username'] = $user -> username;
              $_SESSION['user_role'] = $user -> role_ID;



              $last_visit = date("Y-m-d H:i:s");

              $loginController -> displayLastVisitByUser($last_visit, $_SESSION['user_ID']);
              $loginController -> displayOnlineActiveStatus($_SESSION['user_ID']);



              if($_SESSION['user_role'] == 1)
              {
                echo json_encode(['role' => 1]);exit;
              }
              else if($_SESSION['user_role'] == 2)
              {
                echo json_encode(['role' => 2]);exit;
              }


            }
          }

        }
      }
    }

    else {
      http_response_code(400);
    }

    break;

    case '/logout':

    if(isset($_SESSION['user']))
    {
      $current_user_ID = $_SESSION['user_ID'];

      try {
        $loginController -> displayOfflineActiveStatus($current_user_ID);
      }

      catch(PDOException $e)
      {

        catchErrors($e -> getMessage());
        http_response_code(500);
      }

    }

    else {
      http_response_code(400);
    }

    break;


    case '/products_by_category':

    if(isset($_POST['_category_ID']))
    {
      $category = $_POST['_category_ID'];

      if($category == 0)
      {

        $productController -> displayAllProducts();

      }
      else {
        $productController -> displayAllProductsByCategory($category);
      }
    }

    else {
      http_response_code(400);
    }

    break;

    case '/add_a_category':


    if(isset($_POST['_category_name']))
    {
      $category_value = $_POST['_category_name'];

      $flag = 0;
      $errorAddCategory = '';

      $reCategoryName = '/^[A-z]{2,}(\s([A-z]{2,}))*$/';


      if(!preg_match($reCategoryName, $category_value))

      {
        $flag++;
        $errorAddCategory .= 'Incorrect value!';
      }
      if($flag > 0)
      {
        header('Content-type: application/json');
        echo json_encode(['errAddCategory' => $errorAddCategory]);exit;
      }
      else {
        try {
          $categoryController -> newCategory($category_value);


          $inserted = $categoryController -> newCategory($category_value);

          header('Content-type: application/json');
          echo json_encode(['errAddCategory' => $errorAddCategory]);exit;

        }

        catch(PDOException $e)
        {

          catchErrors($e -> getMessage());
          http_response_code(500);
        }
      }


    }

    else {
      http_response_code(400);
    }

    break;

    case '/add_a_product':

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

    $category_name = $categoryController -> displayCategoryNameById($category_id);

    $dir_name = __DIR__ . '/assets/images/' . $category_name -> name . '/';

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
      $db_img_path = $explode_image[3] . '/' . $explode_image[4];






      try {


        $productController -> newProduct($category_id, $product_name, $product_price, $db_img_path, $product_descr, 1);

      }

      catch(PDOException $e)
      {

        catchErrors($e -> getMessage());
        http_response_code(500);
      }

}





    }

    else {
        http_response_code(400);
    }

    break;

    case '/visits':

    $visitController -> displayAllVisits();

    break;



}
