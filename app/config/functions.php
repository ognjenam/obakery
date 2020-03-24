<?php
function view($filename, $parametersX = [], $parametersY = [])
{
  extract($parametersX);
  extract($parametersY);
  require_once 'app/views/' . $filename . '.php';



}

function includeAdminFiles($filename, $params = [], $countProducts = [])
{
  extract($countProducts);
  extract($params);
  require_once 'app/views/admin/fixed/head.php';
  require_once 'app/views/admin/fixed/nav.php';
  require_once 'app/views/admin/pages/' . $filename . '.php';
  require_once 'app/views/admin/fixed/footer.php';
}

function includeChart($filename, $username, $user_role, $parameterX = [])
{
  extract($parameterX);
  require_once 'app/views/admin/fixed/head.php';
  require_once 'app/views/chart/fixed/nav.php';
  require_once 'app/views/chart/pages/' . $filename . '.php';
  require_once 'app/views/admin/fixed/footer.php';
}

function catchErrors($error)
{
  $file = @ fopen(__DIR__ . '/../data/errors.txt', 'a');

  if($file)
  {
    $date = date('Y-m-d H:i:s');
    $data = $error . "\t" . $date . "\t\n";
    fwrite($file, $data);
    fclose($file);
  }
}

function logActivity($guest)
{
  $file = @ fopen(__DIR__ . '/../data/log.txt', 'a');


  if(isset($_SERVER['HTTP_CLIENT_IP'])){
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }

  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  else if(isset($_SERVER['HTTP_FORWARDED']))
  {
    $ip_address = $_SERVER['HTTP_FORWARDED'];
  }

  else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
  {
    $ip_address = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
  }

  else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }



  if($file)
  {
    $date = date("Y-m-d H:i:s");
    $data = $guest . "\t" . $date . "\t" . $ip_address . "\t" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "\n";
    fwrite($file, $data);
    fclose($file);
  }
}
