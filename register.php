<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require 'vendor/autoload.php';

  Twig_Autoloader::register();
  $loader = new Twig_Loader_Filesystem(__DIR__ . "/templates");
  $twig = new Twig_Environment($loader);


  echo $twig->render('register.tpl.php');

?>
