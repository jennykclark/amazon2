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
if( ! isset( $_POST['instock']) ){ _res(400,['instock is required']); }
if( strlen( $_POST['instock'] ) < _STOCK_PRICE_MIN_LEN ){ _res(400,['instock min '._STOCK_PRICE_MIN_LEN.' characters']); }
if( strlen( $_POST['instock'] ) > _STOCK_PRICE_MAX_LEN ){ _res(400,['instock max '._STOCK_PRICE_MAX_LEN.' characters']); }

$db = require_once(__DIR__.'../../db.php');
$imageName = uniqid();
move_uploaded_file( $_FILES['image']['tmp_name'], "../images/$imageName");

try{

// $q = $db->prepare('UPDATE users SET user_name = :name WHERE user_id = :userID');
$q = $db->prepare('UPDATE items2
               SET item_name = :item_name, 
               item_price = :item_price, 
               description = :description,
               item_img = :item_img,
               item_stock = :instock 
               WHERE item_id = :item_id ');
$q->bindValue(':item_name', $_POST['item_name']);
$q->bindValue(':item_price', $_POST['item_price']);
$q->bindValue(':description', $_POST['description']);
$q->bindValue(":item_img", $imageName); 
$q->bindValue(':instock', $_POST['instock']);
$q->bindValue(":item_id", $_POST['item_id']);

$q->execute();

header('Content-Type: application/json');
// echo '{"info":"user created", "id":"'.$id.'"}';
$response = ["Item has been updated"];
echo json_encode($response);
}catch(PDOException $ex){
    http_response_code(500);
    echo $ex;
    exit();
}