<?php

  include "libs/connectDB.php";

  $db = new Database();
  $db -> query(file_get_contents("nfc.sql"));
  $db -> execute();


?>
