<?php

namespace app\models;

class Product {

private $db;


public function __construct($database)
{
  $this -> db = $database;
}


  public function getAllProducts()
  {
    return $this -> db -> executeQuery('SELECT * FROM product');
  }
  public function getAllProductsAndCategories()
  {
    return $this -> db -> executeQuery('SELECT p.*, c.available as categoryAvailable FROM product p INNER JOIN category c ON p.category_ID = c.category_ID');
  }
  public function paginationLimitProducts()
  {
    return $this -> db -> executeQuery('SELECT p.*, c.available as categoryAvailable FROM product p INNER JOIN category c ON p.category_ID = c.category_ID ORDER BY p.product_ID ASC LIMIT 0,5');
  }

  public function getPagination($limit)
  {
    $query =  $this -> db -> getMyDB() -> prepare("SELECT p.*, c.available as categoryAvailable FROM product p INNER JOIN category c ON p.category_ID = c.category_ID ORDER BY p.product_ID ASC LIMIT $limit,5 ");
    $query -> execute([$limit]);
    return $query -> fetchAll();

  }

  public function addToChart($product, $user, $date)
  {
    $query = $this -> db -> getMyDB() -> prepare('INSERT INTO product_user VALUES(NULL, ?, ?, ?)');
    $query -> execute([$product, $user, $date]);
  }



  public function countAllProducts()
  {
    return $this -> db -> executeOneRow('SELECT COUNT(*) as countAll FROM product');
  }

  public function getProductsByCategory($category_id)
  {
    $query =  $this -> db -> getMyDB() -> prepare('SELECT p.* FROM product p INNER JOIN category c ON p.category_ID = c.category_ID WHERE c.category_ID = ?');
    $query -> execute([$category_id]);
    return $query -> fetchAll();

  }

  public function getProductTroughName($val)
  {
    $query = $this -> db -> getMyDB() -> prepare('SELECT p.*, c.name as categoryName FROM product p INNER JOIN category c ON p.category_ID = c.category_ID WHERE p.name LIKE ?');
    $query -> execute([$val]);
    return $query -> fetch();
  }

  public function getProduct($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('SELECT p.*, c.name AS categoryName, c.available as categoryAvailable  FROM PRODUCT p INNER JOIN CATEGORY C ON p.category_ID = c.category_ID WHERE p.product_ID = ?');
    $query -> execute([$id]);
    return $query -> fetch();
  }

  public function addNewProduct($cat, $name, $price, $img, $info)
  {
    $query = $this -> db -> getMyDB() -> prepare('INSERT INTO product VALUES(NULL, ?, ?, ?, ?, ?, 1)');
    $query -> execute([$cat, $name, $price, $img, $info]);

  }

  public function unavailableProduct($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('UPDATE product SET available = 0 WHERE product_ID = ?');
    $query -> execute([$id]);
  }
  public function availableProduct($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('UPDATE product SET available = 1 WHERE product_ID = ?');
    $query -> execute([$id]);
  }

  public function editProduct($name, $price, $img, $info, $prod_id)
  {
    $query = $this -> db -> getMyDB() -> prepare('UPDATE product SET name = ?, price = ?, image = ?, info = ? WHERE product_id = ?');
    $query -> execute([$name, $price, $img, $info, $prod_id]);
  }
}
