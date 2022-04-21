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

$db = require_once(__DIR__.'../../db.php');
try{
    session_start();
    // $userid = $_SESSION['userId'];
    // $userid = $_SESSION['user']['user_id'];
    $userid = $_POST['userId'];


    $db->beginTransaction();

    //Change name
    $q = $db->prepare('UPDATE users SET user_name = :update_Name WHERE user_id = :userid');
    $q->bindValue(':userid',$userid);
    $q->bindValue(':update_Name', $_POST['name']);
    $q->execute();

    //Change last name
    $q = $db->prepare('UPDATE users SET lastName = :update_lastName WHERE user_id = :userid');
    $q->bindValue(':userid',$userid);
    $q->bindValue(':update_lastName', $_POST['last_name']);
    $q->execute();

    //change email
    $q = $db->prepare('UPDATE users SET email = :update_email WHERE user_id = :userid');
    $q->bindValue(':userid',$userid);
    $q->bindValue(':update_email', $_POST['email']);
    $q->execute();

    // change phone number 
    // $q = $db->prepare('UPDATE users SET phone_number = :update_phone WHERE user_id = :userid');
    // $q->bindValue(':userid',$userid);
    // $q->bindValue(':update_phone', $_POST['phone_number']);
    // $q->execute();

    $db->commit(); 
    header('Content-Type: application/json');
    $response = ["info" => "info has been updated"];
    echo json_encode($response);

    


}catch(Exception $ex){
    http_response_code(500);
    echo $ex;
    echo 'System under maintainance';
    exit();
}