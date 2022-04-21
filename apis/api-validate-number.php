<?php
require_once(__DIR__ . "../../globals.php");
session_start();

//Initial validation of the inputs
if (empty($_POST['phone_number'])) {
    //send_400('mmm... suspicious (No number has been found) ');
    _res(400,['mmm... suspicious (No number has been found)']);
    exit();
}
if (!isset($_POST['phone_number'])) {
  //  send_400('mmm... suspicious (No number has been found) ');
    _res(400,['mmm... suspicious (No number has been found)']);
    exit();
}
if (strlen($_POST['phone_number']) != 8) {
    // send_400('Sry, this needs to be a danish number (8 digits) ');
    _res(400,['Sry, this needs to be a danish number (8 digits) ']);
    exit();
}

// Validation of database connection
try {
    $db = _db();
} catch (Exception $ex) {
    // send_500('Database failed - System under maintainance');
    _res(500,['database fail']);
    echo json_encode($ex);
}

//Looking for user with id, and fetching verification_key from row.
try {


$user_id = $_POST['user_id']; 
$phone_data = ['api_key' => '0d10ce6e-be1e-4f42-8e9e-7c169bc58a2f', 'to_phone' => $_POST['phone_number'], 'message' => 'Thank you for creating Amazon account. Your account is now linked with this phone number.'];
$ch = curl_init("https://fatsms.com/send-sms");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $phone_data);
$sms_response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
$response = ["info" => "user created", "user_id" => $user_id];
echo json_encode($response);
} catch (Exception $ex) {
    echo $ex;
    _res(500,['That didnt work - try again, or contact an adult']);
    // send_500('That didnt work - try again, or contact an adult');
}