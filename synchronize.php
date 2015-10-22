<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

  $sql = file_get_contents("nfc.sql");

  require("libs/connectDB.php");

  $db = new Database();

  $db->query($sql);

  $db->execute();


?>
