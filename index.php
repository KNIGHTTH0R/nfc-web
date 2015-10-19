<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

  require "libs/Router.php";
  require "vendor/autoload.php";
  require 'libs/Rest.php';
  require $_SERVER["DOCUMENT_ROOT"]."/libs/connectDB.php";
  require $_SERVER["DOCUMENT_ROOT"]."/libs/Auth.php";

  Twig_Autoloader::register();
  $loader = new Twig_Loader_Filesystem(__DIR__ . "/templates");
  $twig = new Twig_Environment($loader);



    Router::route('/item/(\d+)', function($id){
      global $twig;
      require "controllers/item.php";
    });

    Router::route('/', function(){
      global $twig;
      require "controllers/index.php";
    });

    Router::route('/edit', function(){
      global $twig;
      require "controllers/edit.php";
    });

    Router::execute($_SERVER['REQUEST_URI']);


?>
