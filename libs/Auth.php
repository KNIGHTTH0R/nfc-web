<?php

class Auth{

  private $db;

  public function __construct(){
  }

  public function setDb($db){
      $this -> db = $db;
  }

  public function validate(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION["id"])){
      if($_SESSION["timeout"] < time()){
        session_destroy();
        header("Location: /");
        die();
      }else{
        return $_SESSION["id"];
      }
    }else{
      session_destroy();
      header("Location: /");
      die();
    }
  }

  public function verify($username, $password){
    if($username == "" || $password == ""){
      return json_encode(array("status"=>"error","message" => "Musíte vyplnit všechny údaje"));
    }
    $this->db->query('SELECT salt, password FROM places WHERE username = :user LIMIT 1');
    $this->db->bind(':user', $username);
    $result = $this->db -> getArray();
    if(!$result){
      return json_encode(array("status"=>"error","message" => "Neexistující jméno"));
    }else{
      $salt = $result[0]["salt"];
      $token = hash('sha256', $password.$salt);
    }
    $this->db->query('SELECT id FROM places WHERE username = :user AND password = :pass LIMIT 1');
    $this->db->bind(':user', $username);
    $this->db->bind(':pass', $token);
    $result = $this->db->getArray();
    if(!$result){
      return json_encode(array("status"=>"error","message" => "Špatné heslo"));
    }else{
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
      $_SESSION["id"] = $result[0]["id"];
      // 30 MINUTE TIMEOUT;
      $timeout = time()+(30*60);
      $_SESSION["timeout"] = $timeout;
      return json_encode(array("status"=>"ok","message" => "OK"));
    }
  }
}


?>
