<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require 'vendor/autoload.php';

  require "libs/Auth.php";

  $auth = new Auth();
  $auth->validate();

  Twig_Autoloader::register();
  $loader = new Twig_Loader_Filesystem(__DIR__ . "/templates");
  $twig = new Twig_Environment($loader);


// TODO: PRETTY URL

  $id = $_GET["id"];

  $service_url = 'http://'.$_SERVER["SERVER_NAME"].'/api/items/'.$id;
  $curl = curl_init($service_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $curl_response = curl_exec($curl);
  curl_close($curl);

  $item = json_decode($curl_response)[0];

  $item->mtime = filemtime($_SERVER["DOCUMENT_ROOT"] ."/assets/images/item_".$item->id.".jpg");


  echo $twig->render('item.tpl.php', array("item" => $item));

?>
