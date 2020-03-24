<?php


class DB {

  private $database;
  private $server;
  private $username;
  private $password;

  public $conn;

  public function __construct($server, $db, $username, $pass)
  {
    $this -> server = $server;
    $this -> database = $db;
    $this -> username = $username;
    $this -> password = $pass;

    $this -> conn = new PDO("mysql:host={$this -> server};dbname={$this -> database};charset=utf8", $this -> username, $this -> password);
    $this -> conn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }

  public function getMyDB()
  {
    if($this -> conn instanceOf PDO)
    {
      return $this -> conn;
    }
  }

  public function executeQuery($query)
  {
    return $this -> conn -> query($query) -> fetchAll();
  }

  public function executeOneRow($query)
  {
    return $this -> conn -> query($query) -> fetch();
  }


 //  public function userByUsername($username)
 // {
 //   $query = $this -> conn -> prepare("SELECT * from user where username = ?");
 //   $query -> execute([$username]);
 //   return $query -> fetch();
 // }

 public function visits()
 {
   $query = $this -> conn -> prepare("UPDATE visits SET number = number + 1");
   $query -> execute();
 }


}
