<?php

  $auth = new Auth();
  $id = $auth->validate();

  $c = new Rest();

  $res = $c->get('http://'.$_SERVER["SERVER_NAME"].'/api/places/'.$id.'/items');

///// Workaround for Endora hosting
  $res = getStringBetween($res, "[","]");
  $items = json_decode("[".$res."]");
////

  $items = json_decode($res);

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


function getStringBetween($str,$from,$to){
  $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
  return substr($sub,0,strpos($sub,$to));
}



?>
