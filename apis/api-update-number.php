<?php
require_once(__DIR__ . "../../globals.php");
$db = require_once(__DIR__.'../../db.php');
session_start();

//Initial validation of the inputs
if (empty($_POST['phone_number'])) {
    
    _res(400,['(No number has been found)']);
    exit();
}
if (!isset($_POST['phone_number'])) {
  
    _res(400,['(No number has been found)']);
    exit();
}
if (strlen($_POST['phone_number']) != 8) {
    
    _res(400,['Sry, this needs to be a danish number (8 digits) ']);
    exit();
}

// Validation of database connection
try {
    $db = _db();
} catch (Exception $ex) {
    _res(500,['database fail System under maintainance']);
    echo json_encode($ex);
}

try {


    $q = $db->prepare("UPDATE users SET phone_number = :phone_number WHERE user_id = :user_id");
    $q->bindValue(':phone_number',$_POST['phone_number']);
$q->bindValue(':user_id', $_POST['user_id']);
$q->execute();

$phone_data = ['api_key' => '0d10ce6e-be1e-4f42-8e9e-7c169bc58a2f', 'to_phone' => $_POST['phone_number'], 'message' => 'Thank you, you have updated your phone number.'];
$ch = curl_init("https://fatsms.com/send-sms");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $phone_data);
$sms_response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
$response = ["info" => "user has been updated "];
echo json_encode($response);
} catch (Exception $ex) {
    echo $ex;
    _res(500,['That didnt work - try again, or an different phone number']);
}