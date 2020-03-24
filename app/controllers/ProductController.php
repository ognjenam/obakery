<?php

require_once __DIR__.'/../models/Product.php';

require_once __DIR__.'/../models/Category.php';

use app\models\Category;
use app\models\Product;

class ProductController {
  public function displayAllProductsAndAllCategories()
  {
    global $database;
    $productModel = new Product($database);
    $categoryModel = new Category($database);

    $products = $productModel -> getAllProducts();
    $categories = $categoryModel -> getAllCategories();

    view('pages/products', ['allProducts' => $products], ['allCategories' => $categories]);
  }


  public function displayAllProductsByCategory($category)
  {
    global $database;
    $productModel= new Product($database);

    $products = $productModel -> getProductsByCategory($category);

    header('Content-type: application/json');
    echo json_encode(['products' => $products]);exit;

    // return $products;

  }

  public function displayProductTroughSearch($val)
  {
    global $database;
    $productModel = new Product($database);
    $product = $productModel -> getProductTroughName($val);
    header('Content-type: application/json');

    if($product)
    {
      $product_id = $product -> product_ID;

      $product_final = $productModel -> getProduct($product_id);


      echo json_encode(['product' => $product_final]);exit;
    }

    else {

      echo json_encode(['product' => false]);exit;
    }




    // return $product;
  }





  public function displayProductById($id)
  {
    global $database;
    $productModel = new Product($database);
    // $product = $productModel -> getProduct($id);

    $user = $_SESSION['user'] -> user_ID;
    $date = date("Y-m-d H:i:s");

    $inserted = $productModel -> addToChart($id, $user, $date);

    header('Content-type: application/json');
    echo json_encode(['inserted' => true]);exit;





  }

  // public function displayToChart($product, $user, $date)
  // {
  //   global $database;
  //   $productModel = new Product($database);
  //   $chart = $productModel -> addToChart($product, $user, $date);
  //
  //
  // }


  public function displayProductByIdAdminPanel($id)
  {
    global $database;
    $productModel = new Product($database);
    $product = $productModel -> getProduct($id);

    // return $product;

    includeAdminFiles('/edit_product', ['product' => $product]);


  }

  public function displayProductByIdEdit($id)
  {
    global $database;
    $productModel = new Product($database);
    $product = $productModel -> getProduct($id);




    return $product;


  }


  public function displayAllProducts()
    {
      global $database;
      $productModel = new Product($database);
      $products = $productModel -> getAllProducts();

      header('Content-type: application/json');
      echo json_encode(['products' => $products]);exit;



      // return $products;


    }

    public function displayProduct($id)
    {
      global $database;
      $productModel = new Product($database);
      $result = $productModel -> getProduct($id);
      view('pages/details', ['product' => $result]);

    }

    public function newProduct($cat, $name, $price, $img, $info)
    {
      global $database;
      $productModel = new Product($database);
      $productModel -> addNewProduct($cat, $name, $price, $img, $info);
    }

    public function removeProduct($id)
    {
      global $database;
      $productModel = new Product($database);
      $productModel -> unavailableProduct($id);

      header('Content-type: application/json');
      echo json_encode(['removed' => true]);
    }

    public function displayBackProduct($id)
    {
      global $database;
      $productModel = new Product($database);
      $productModel -> availableProduct($id);

      header('Content-type: application/json');
      echo json_encode(['backed' => true]);
    }



    public function allProductsAndCategories()
    {
      global $database;
      $productModel = new Product($database);

      $products = $productModel -> paginationLimitProducts();
      $number = $productModel -> countAllProducts();

      includeAdminFiles('/products', ['products' => $products], ['numberOfProducts' => $number]);

    }

    public function displayPagination($limit)
    {
      global $database;
      $productModel = new Product($database);

      $products = $productModel -> getPagination($limit);
      $number = $productModel -> countAllProducts();


      includeAdminFiles('/products', ['products' => $products], ['numberOfProducts' => $number]);
    }

    // public function totalProducts()
    // {
    //   global $database;
    //   $productModel= new Product($database);
    //   $number = $productModel -> countAllProducts();
    //   return $number;
    //
    //
    //
    // }

    public function updateProduct($product_name, $product_price, $new_image_updated, $info, $prod_id)
    {
      global $database;
      $productModel = new Product($database);
      $productModel -> editProduct($product_name, $product_price, $new_image_updated, $info, $prod_id);

    }




}
