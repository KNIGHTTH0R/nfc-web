<?php

$app->get('/places/:owner/items', function($owner){
  //fetch all items
  $app = \Slim\Slim::getInstance();
  $db = new Database();
  $db->query('SELECT id, name, description,image, tag_id FROM items WHERE owner = :owner');
  $db->bind(':owner', $owner);
  $app->response->setStatus(200);
  echo $db -> getJSON();
});

$app->get('/items/:id', function($id){
  // Fetch single item
  $app = \Slim\Slim::getInstance();
  $db = new Database();
  $db->query('SELECT id, name, description,image FROM items WHERE id = :id LIMIT 1');
  $db->bind(':id', $id);
  $app->response->setStatus(200);
  echo $db -> getJSON();
});

$app->put('/items/:id', function($id){
  // Update item
  $app = \Slim\Slim::getInstance();
  $data = $app->request->post();
  $db = new Database();
  $db->query('UPDATE items SET name = :name, description = :description WHERE id = :id');
  $db->bind(':id', $id);
  $db->bind(':name', $data["name"]);
  $db->bind(':description', $data["description"]);
  $db->execute();
  $app = \Slim\Slim::getInstance();
  $app->response->setStatus(200);
  echo json_encode(array("status" => "success", "code" => 1));
});

$app->post('/items/:id/tag', function($id){
  //Update item tag id
  $app = \Slim\Slim::getInstance();
  $data = $app->request->post();
  $db = new Database();

  $db->query('UPDATE items SET tag_id = 0 WHERE tag_id = :tag_id');
  $db->bind(':tag_id', $data["tag_id"]);
  $db->execute();

  $db->query('UPDATE items SET tag_id = :tag_id WHERE id = :id');
  $db->bind(':id', $id);
  $db->bind(':tag_id', $data["tag_id"]);

  $db->execute();
  $app = \Slim\Slim::getInstance();
  $app->response->setStatus(200);
  echo json_encode(array("status" => "ok", "code" => 1));
});

$app->post('/items/', function(){
  // Insert new item
  $app = \Slim\Slim::getInstance();
  $data = $app->request->post();
  $db = new Database();
  $db->query('INSERT INTO items (owner, name, image) SELECT :owner,:name, CONCAT("item_", MAX(`id`)+1) FROM items');
  $db->bind(':name', $data["name"]);
  $db->bind(':owner',$data["owner"]);
  $db->execute();
  $app = \Slim\Slim::getInstance();
  $app->response->setStatus(200);
  echo json_encode(array("status" => "success", "code" => 1));
});


?>
