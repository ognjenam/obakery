<?php
require_once 'app/models/Visit.php';

use app\models\Visit;


class VisitController {


  public function displayAllVisits()
  {
    global $database;

    $visitModel = new Visit($database);
    $visits = $visitModel -> countAllVisits();

    $date = date("m/d");

    $january = "01/01";

    if($date == $january)
    {
      $visitModel -> restartVisits();
    }
    header("Content-type: application/json");
    echo json_encode(['visits' => $visits]);exit;


    // return $visits;
  }

  // public function newYearVisits()
  // {
  //   global $database;
  //
  //   $visitModel = new Visit($database);
  //   $updateVisits = $visitModel -> restartVisits();
  // }
}
