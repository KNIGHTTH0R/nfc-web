<?php

  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require $_SERVER["DOCUMENT_ROOT"]."/libs/connectDB.php";
  require $_SERVER["DOCUMENT_ROOT"]."/libs/Auth.php";

  $db = new Database();
  $auth = new Auth();
  $auth->setDb($db);

  print $auth -> verify($_REQUEST["username"], $_REQUEST["password"]);
  die();
?>
