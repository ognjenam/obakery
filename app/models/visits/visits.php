<?php
header("Content-Type: application/json");
session_start();
require_once '../../config/DB.php';
require_once '../../config/database.php';
require_once '../../controllers/VisitController.php';



$database = new DB(SERVER, DATABASE, USERNAME, PASS);
$visitController = new VisitController();
$visits = $visitController -> displayAllVisits();

$date = date("m/d");

$january = "01/01";

if($date == $january)
{
  $newYearVisits = $visitController -> newYearVisits();
}


echo json_encode(['visits' => $visits]);exit;
