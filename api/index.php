<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require "../libs/connectDB.php";

$app = new \Slim\Slim;


$app->get('/', function() {
    $app = \Slim\Slim::getInstance();
    $app->response->setStatus(200);
    echo "Welcome to Slim 3.0 based API";
});

$app->get('/places', function(){
  $db = new Database();
  $db->query('SELECT id, name FROM places');
  $app = \Slim\Slim::getInstance();
  $app->response->setStatus(200);
  echo $db -> getJSON();
  echo $db -> error;
});

$app->get('/places/:id', function($id){
  $app = \Slim\Slim::getInstance();
  $db = new Database();
  $db->query('SELECT id, name FROM places WHERE id = :id');
  $db->bind(':id', $id);
  $app->response->setStatus(200);
  echo $db -> getJSON();
});

$app->put('/places/:id', function($id){
  $app = \Slim\Slim::getInstance();
  $data = $app->request->post();
  $db = new Database();
  $db->query('UPDATE places SET name = :name WHERE id = :id');
  $db->bind(':id', $id);
  $db->bind(':name', $data["name"]);
  $db->execute();
  $app = \Slim\Slim::getInstance();
  $app->response->setStatus(200);
  echo json_encode(array("status" => "success", "code" => 1));
});

$app->put('/places/:id', function($id){
  $app = \Slim\Slim::getInstance();
  $data = $app->request->post();
  $db = new Database();
  $db->query('INSERT INTO places (name, password, salt) VALUES ( :name, :password, :salt)');
  $db->bind(':name', $data["name"]);
  $db->bind(':password', $data[":password"]);
  $db->bind(':salt', $data[":salt"]);
  $db->execute();
  $app = \Slim\Slim::getInstance();
  $app->response->setStatus(200);
  echo json_encode(array("status" => "success", "code" => 1));
});


$app->post('/register/', function(){
  $app = \Slim\Slim::getInstance();
  $response = $app->response();
  $response['Content-Type'] = 'application/json';
  $data = $app->request->post();
  $db = new Database();
  $username = $data["username"];
  $password = $data["password"];
  $password2 = $data["password2"];

  if($username == "" || $password == "")  $app->halt(400,json_encode(array("status"=>"error","message" => "Musíte vyplnit všechny údaje")));
  if($password != $password2)             $app->halt(400,json_encode(array("status"=>"error","message" => "Hesla se neshodují")));
  if(strlen($username)< 5)               $app->halt(400,json_encode(array("status"=>"error","message" => "Jméno je příliš krátké")));
  if(strlen($password)< 5)               $app->halt(400,json_encode(array("status"=>"error","message" => "Heslo je příliš krátké")));

  $db->query('SELECT id FROM places WHERE username = :user LIMIT 1');
  $db->bind(':user', $username);
  $result = $db -> getArray();

  if($result) $app->halt(400,json_encode(array("status"=>"error", "message" => "Uživatel již existuje")));

  $salt = md5(bin2hex(openssl_random_pseudo_bytes(50)));
  $password = hash('sha256', $password.$salt);
  $db->query('INSERT INTO places (username, password, salt) VALUES (:username, :password, :salt)');
  $db->bind(":username", $username);
  $db->bind(":salt", $salt);
  $db->bind(":password", $password);
  $db->execute();

  $app->response->setStatus(200);
  echo json_encode(array("status" => "success", "message" => "OK"));
});



include("items.php");

$app->run();


?>
