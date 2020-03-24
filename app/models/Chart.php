<?php


namespace app\models;

class Chart


{

  private $db;


  public function __construct($database)
  {
    $this -> db = $database;
  }

  public function getAllOrdersByUserId($user_id)
  {
    $query =  $this -> db -> getMyDB() -> prepare('SELECT pu.*, p.name AS productName, p.price as productPrice, p.image as productImage, u.username FROM product_user pu INNER JOIN product p ON pu.product_ID = p.product_ID INNER JOIN user u on pu.user_ID = u.user_ID WHERE u.user_ID = ?');
    $query -> execute([$user_id]);
    return $query -> fetchAll();
  }

  public function deleteProductFromChart($id)
  {
    $query =  $this -> db -> getMyDB() -> prepare('DELETE from product_user WHERE product_user_ID = ?');
    $query -> execute([$id]);
  }


}
