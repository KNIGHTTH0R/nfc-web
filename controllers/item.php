<?php
  $auth = new Auth();
  $auth->validate();

  $service_url = 'http://'.$_SERVER["SERVER_NAME"].'/api/items/'.$id;
  $curl = curl_init($service_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $curl_response = curl_exec($curl);
  curl_close($curl);

  $item = json_decode($curl_response)[0];

  $path = $_SERVER["DOCUMENT_ROOT"] ."/assets/images/item_".$item->id.".jpg";
  if(file_exists($path)){
    $item->imgurl = "assets/images/".$item->image.".jpg?".filemtime($path);
  }else{
    $item->imgurl = "assets/default-image.jpg";
  }

  echo $twig->render('item.tpl.php', array("item" => $item));

?>
