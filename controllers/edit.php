<?php

  $auth = new Auth();
  $id = $auth->validate();



  $c = new Rest();

  $res = $c->get('http://'.$_SERVER["SERVER_NAME"].'/api/places/'.$id.'/items');



  $items = json_decode($res);

  var_dump($items);

  //removing cached version of image
 foreach ($items as $item) {
   $path = $_SERVER["DOCUMENT_ROOT"] ."/assets/images/item_".$item->id.".jpg";
   if(file_exists($path)){
     $item->imgurl = "assets/images/".$item->image.".jpg?".filemtime($path);
   }else{
     $item->imgurl = "assets/default-image.jpg";
   }
 }
  echo $twig->render('edit.tpl.php', array("items" => $items));


?>
