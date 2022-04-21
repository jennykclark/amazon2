<?php

require_once(__DIR__.'../../globals.php');
// Validate name
if( ! isset( $_POST['name'] ) ){ _res(400,['name is required']); }
if( strlen( $_POST['name'] ) < _FRIST_NAME_MIN_LEN ){ _res(400,['name min '._FRIST_NAME_MIN_LEN.' characters']); }
if( strlen( $_POST['name'] ) > _FRIST_NAME_MAX_LEN ){ _res(400,['name max '._FRIST_NAME_MAX_LEN.' characters']); }

// Validate last_name
if( ! isset( $_POST['last_name'] ) ){ _res(400,['last_name is required']); }
if( strlen( $_POST['last_name'] ) < _LAST_NAME_MIN_LEN ){ _res(400,['last_name min '._LAST_NAME_MIN_LEN.' characters']); }
if( strlen( $_POST['last_name'] ) > _LAST_NAME_MAX_LEN ){ _res(400,['last_name max '._LAST_NAME_MAX_LEN.' characters']); }

// Validate email
if( ! isset( $_POST['email'] ) ){ _res(400,['email is required']); }
if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ){ _res(400,['email is invalid']); }

// validate phone 
if ( ! isset( $_POST['phone'] ) ){ _res(400,['Phone is required']); }
// if ( ! strlen( $_POST['phone_number'] ) > _PHONE_NUMBER_MIN_LEN){ _res(400,['phone number mix '._PHONE_NUMBER_MIN_LEN.' characters']); }

//Validate password
if( ! isset( $_POST['password']) ){ _res(400,['password is required']); }
if( strlen( $_POST['password'] ) < _PASSWORD_MIN_LEN ){ _res(400,['password min'._PASSWORD_MIN_LEN.' characters']); }
if( strlen( $_POST['password'] ) > _PASSWORD_MAX_LEN ){ _res(400,['password max'._PASSWORD_MAX_LEN.' characters']); }


// Connect to DB
// include / require
$db = require_once(__DIR__.'../../db.php');

// try{
// $stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
// $stmt->bindValue(":email", $_POST['email']);
// $stmt->execute();

// $user = $stmt->fetch();
// if ($user){
//   http_response_code(400);
//   echo("Unable to create account, user's email already exists");
// }
// }catch(Exception $ex){
//   http_response_code(400);
// echo('System under maintainance').__LINE__;
// die();
// }


try{
  // Insert data in the DB
  $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $verified	= 0;
  $verification_key = bin2hex(random_bytes(16));

  $q = $db->prepare('INSERT INTO users 
  
  VALUES(:user_id, :user_name, :lastName, :email, :phone_number, :password, :verified, :verification_key)');
  $q->bindValue(":user_id", null); // The db will give this automati.
  $q->bindValue(":user_name", $_POST['name']);
  $q->bindValue(":lastName", $_POST['last_name']);
  $q->bindValue(":email", $_POST['email']);
  $q->bindValue(":phone_number", $_POST['phone']);
  $q->bindValue(":password", $hash_password);
  $q->bindValue(":verified", $verified);
  $q->bindValue(":verification_key", $verification_key);
  $q->execute();
  $id = $db->lastInsertId();

  // $user = array('user_id'=> null, 'user_name'=> $_POST['name'], 'lastName'=> $_POST['last_name'], 'email'=> $_POST['email']);
  $user = array('user_id'=> $id, 'user_name'=> $_POST['name'], 'lastName'=> $_POST['last_name'], 'email'=> $_POST['email'], 'phone_number'=> $_POST['phone'], 'password'=> $hash_password, 'verified' => $verified, 'verification_key' => $verification_key);
  // $user = array('user_id'=> $user_id, 'user_name'=> $_POST['name'], 'lastName'=> $_POST['last_name'], 'email'=> $_POST['email']);


  // SUCCESS
  header('Content-Type: application/json');
  // echo '{"info":"user created", "id":"'.$id.'"}';
  $response = ["info" => "user created", "id" => intval($id)];
  echo json_encode($response);

  //session 
  session_start();
  $_SESSION['user'] = $user;



  
}catch(Exception $ex){
  http_response_code(500);
  echo 'System under maintainance';
  exit();
}