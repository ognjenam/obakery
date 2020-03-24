<?php

namespace app\models;

class Category {
  private $db;

  public function __construct($database)
  {
    $this -> db = $database;
  }


  public function getAllCategories()
  {
    return $this -> db -> executeQuery('SELECT * FROM category');
  }

  public function countAllProductsByCategory()
  {
    return $this -> db -> executeQuery('SELECT c.name as categoryName, c.available, c.category_ID as category_ID, COUNT(p.category_ID) as productsNumber FROM product p RIGHT JOIN category c ON p.category_ID = c.category_ID  GROUP BY c.name ORDER BY c.category_ID ASC');
  }

  public function addCategory($value)
  {
    $query = $this -> db -> getMyDB() -> prepare('INSERT INTO category VALUES(NULL, ?, 1)');
    $query -> execute([$value]);

  }

  public function editCategoryName($value, $id)
  {
    $query = $this -> db -> getMyDB() -> prepare('UPDATE category SET name = ? WHERE category_ID = ?');
    $query -> execute([$value, $id]);

  }

  public function getCategoryName($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('SELECT name FROM category WHERE category_ID = ?');
    $query -> execute([$id]);
    return $query -> fetch();
  }

  public function getCategory($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('SELECT * FROM category WHERE category_ID = ?');
    $query -> execute([$id]);
    return $query -> fetch();
  }

  public function unavailableCategory($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('UPDATE category SET available = 0 WHERE category_ID = ?');
    $query -> execute([$id]);
  }
  public function availableCategory($id)
  {
    $query = $this -> db -> getMyDB() -> prepare('UPDATE category SET available = 1 WHERE category_ID = ?');
    $query -> execute([$id]);
  }


}
