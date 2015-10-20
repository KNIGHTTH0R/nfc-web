<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

  require $_SERVER["DOCUMENT_ROOT"]."/libs/Rest.php";
  require $_SERVER["DOCUMENT_ROOT"]."/libs/Auth.php";

  if(!isset($_POST["url"])) die("Invalid URL");

  $auth = new Auth();
  $id = $auth->validate();

  $url = 'http://'.$_SERVER["SERVER_NAME"].'/api/'.$_POST["url"]."/";
  unset($_POST["url"]);

  $rest = new Rest();

  $data = $_POST;
  $data["owner"] = $id;


  $res = $rest->post(
    $url, $data
  );

  die($res);


?>
