<?php

require_once(__DIR__.'../../globals.php');
// Validate name
if( ! isset( $_POST['item_name'] ) ){ _res(400,['item name is required']); }
if( strlen( $_POST['item_name'] ) < _ITEM_MIN_LEN ){ _res(400,['item name min '._ITEM_MIN_LEN.' characters']); }
if( strlen( $_POST['item_name'] ) > _ITEM_MAX_LEN ){ _res(400,['item name max '._ITEM_MAX_LEN.' characters']); }

// // Validate item_price
if( ! isset( $_POST['item_price'] ) ){ _res(400,['item price is required']); }
if( strlen( $_POST['item_price'] ) < _ITEM_PRICE_MIN_LEN ){ _res(400,['item price min '._ITEM_PRICE_MIN_LEN.' characters']); }
if( strlen( $_POST['item_price'] ) > _ITEM_PRICE_MAX_LEN ){ _res(400,['item price max '._ITEM_PRICE_MAX_LEN.' characters']); }

// // Validate description
if( ! isset( $_POST['description'] ) ){ _res(400,['description is required']); }
if( strlen( $_POST['description'] ) < _DESC_MIN_LEN ){ _res(400,['description min '._DESC_MIN_LEN.' characters']); }

//Validate item_stock
if( ! isset( $_POST['item_stock']) ){ _res(400,['item_stock is required']); }
if( strlen( $_POST['item_stock'] ) < _STOCK_PRICE_MIN_LEN ){ _res(400,['item_stock min '._STOCK_PRICE_MIN_LEN.' characters']); }
if( strlen( $_POST['item_stock'] ) > _STOCK_PRICE_MAX_LEN ){ _res(400,['item_stock max '._STOCK_PRICE_MAX_LEN.' characters']); }


$imageName = uniqid();
move_uploaded_file( $_FILES['image']['tmp_name'], "../images/$imageName");

// Connect to DB
// include / require
$db = require_once(__DIR__.'../../db.php');

try{
  

  // Insert data in the DB
  $item_id = bin2hex(random_bytes(16));
  $updateKey = bin2hex(random_bytes(2));
 $q = $db->prepare('INSERT INTO items2
 VALUES(:item_id, :item_name, :item_price, :description, :item_img, :item_stock, :update_key, :user_id)');
 $q->bindValue(":item_id",$item_id);
 $q->bindValue(":item_name",$_POST['item_name']);
 $q->bindValue(":item_price",$_POST['item_price']);
 $q->bindValue(":description",$_POST['description']);
 $q->bindValue(":item_img", $imageName); 
//  $q->bindValue(":item_img",$_POST['item_img']);
 $q->bindValue(":item_stock",$_POST['item_stock']);
 $q->bindValue(":update_key",$updateKey);
 $q->bindValue(":user_id",$_POST['user_id']);
  $q->execute();

  // SUCCESS
  header('Content-Type: application/json');
 
  $response = ["Item has been uploaded"];
  echo json_encode($response);
  

}catch(Exception $ex){
  http_response_code(500);
  echo 'System under maintainance'.__LINE__;
  exit();
}

// function to manage responding in case of an error
function send_400($error_message){
  header('Content-Type: application/json');
  http_response_code(400);
  $response = ["info"=>$error_message];
  echo json_encode($response);
  exit();
}