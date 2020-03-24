<?php
require_once __DIR__ . '/../models/Chart.php';

use app\models\Chart;


class ChartController
{


  public function displayAllOrdersByUserId($user)
  {
    global $database;

    $chartModel = new Chart($database);

    $chart = $chartModel -> getAllOrdersByUserId($user);
    $username = $_SESSION['user'] -> username;
    $user_role = $_SESSION['user'] -> role_ID;
    includeChart('chart', $username, $user_role,  ['chart' => $chart]);
  }

  public function deletedFromChart($id, $user_id)
  {
    global $database;
    $chartModel = new Chart($database);

    $chartModel -> deleteProductFromChart($id);

    $chart = $chartModel -> getAllOrdersByUserId($user_id);

    header('Content-type: application/json');
    echo json_encode(['chart' => $chart]);exit;



  }

  public function displayAllOrdersByUserIdAjax($user)
  {
    global $database;

    $chartModel = new Chart($database);

    $chart = $chartModel -> getAllOrdersByUserId($user);
    return $chart;
  }
}
