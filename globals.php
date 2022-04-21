<?php

define( '_PASSWORD_MIN_LEN', 5 );
define( '_PASSWORD_MAX_LEN', 20 );

define('_ITEM_MIN_LEN', 5);
define('_ITEM_MAX_LEN', 255);

define('_ITEM_PRICE_MIN_LEN', 2);
define('_ITEM_PRICE_MAX_LEN', 10);

define('_STOCK_PRICE_MIN_LEN', 1);
define('_STOCK_PRICE_MAX_LEN', 10);

define('_DESC_MIN_LEN', 5);

define('_FRIST_NAME_MIN_LEN', 5);
define('_FRIST_NAME_MAX_LEN', 20);

define('_LAST_NAME_MIN_LEN', 5);
define('_LAST_NAME_MAX_LEN', 20);

define('_PHONE_NUMBER_MIN_LEN', 8);
define('_PHONE_NUMBER_MAX_LEN', 8);


// ##############################
function _res( $status=200, $message=[] ){
  http_response_code($status); 
  header('Content-Type: application/json'); 
  echo json_encode($message); 
  exit();
}


// ##############################
function _db(){
  $database_user_name = 'root';
  $database_password = '';
  $database_connection = 'mysql:host=localhost; dbname=company; charset=utf8mb4';

  $database_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  return new PDO( $database_connection, $database_user_name, $database_password, $database_options ); 
}

// function _api_db(){
//   try{
//     $database_user_name = 'root';
//     $database_password = '';
//     $database_connection = 'mysql:host=localhost; dbname=company; charset=utf8mb4';
    
//     $database_options = [
//       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//       // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
//       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ];
//     return new PDO( $database_connection, $database_user_name, $database_password, $database_options ); 
//   }catch(Exception $ex){
//     http_response_code(500);
//     echo "System under maintainance";
//   }
// }
