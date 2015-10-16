<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

ob_implicit_flush(true);
ob_end_flush();

//if ( isset($_FILES['file']) ) {

  $name = $_POST["name"].".jpg";
  $error = false;
  $message = null;

  $path = '../assets/images/'.$name;


  switch(strtolower($_FILES['file']['type'])){
    case 'image/png':
    case 'image/jpg':
    case 'image/jpeg':
    case 'image/pjpeg':
        break;
    default:
      $error = true;
      $message = "Neznámá přípona souboru";
  }

  if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){
    if(!$error){
      $im = new Imagick($path);
      $im->setImageBackgroundColor('white');
      $im = $im->flattenImages();
      $im->setImageFormat('jpg');
      $im->setImageCompression(Imagick::COMPRESSION_JPEG);
      $im->setImageCompressionQuality(90);
      $im->scaleImage(1280, 0);
      $im->writeImage($path);
    }
  }else{
    $error = true;
    $message = "Nelze uložit tento soubor";
  }


  $response = array(
      'error' => $error,
      'message' => $message,
      'filename' => $path,
      'filepath' => $path
  );
  echo json_encode($response);

  die();
//}


?>
