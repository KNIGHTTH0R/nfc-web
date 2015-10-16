<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require 'vendor/autoload.php';
  require "libs/Auth.php";

  $auth = new Auth();
  $id = $auth->validate();

  Twig_Autoloader::register();
  $loader = new Twig_Loader_Filesystem(__DIR__ . "/templates");
  $twig = new Twig_Environment($loader);


  $service_url = 'http://'.$_SERVER["SERVER_NAME"].'/api/places/'.$id.'/items';
  $curl = curl_init($service_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $curl_response = curl_exec($curl);
  curl_close($curl);

  $items = json_decode($curl_response);


  //removing cached version of image
  foreach ($items as $item) {
    $item->mtime = filemtime($_SERVER["DOCUMENT_ROOT"] ."/assets/images/item_".$item->id.".jpg");
  }


    echo $twig->render('edit.tpl.php', array("items" => $items));

?>
